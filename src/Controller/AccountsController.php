<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Form\AccountsType;
use App\Form\Filter\AccountFilterType;
use App\Repository\AccountRepository;
use Knp\Component\Pager\PaginatorInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdaterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accounts")
 */
class AccountsController extends AbstractController
{
    /**
     * @Route("/", name="accounts_index", methods={"GET"})
     * @param AccountRepository $accountRepository
     * @param PaginatorInterface $paginator
     * @param FilterBuilderUpdaterInterface $builderUpdater
     * @param Request $request
     * @return Response
     */
    public function index(
        AccountRepository $accountRepository,
        PaginatorInterface $paginator,
        FilterBuilderUpdaterInterface $builderUpdater,
        Request $request
    ): Response {
        $qb = $accountRepository->queryAll();

        $filterForm = $this->createForm(AccountFilterType::class, null, [
            'method' => 'GET'
        ]);

        if ($request->query->has($filterForm->getName())) {
            $filterForm->submit($request->query->get($filterForm->getName()));
            $builderUpdater->addFilterConditions($filterForm, $qb);
        }

        $accounts = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('accounts/index.html.twig', [
            'accounts' => $accounts,
            'filters' => $filterForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="accounts_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $account = new Accounts();
        $form = $this->createForm(AccountsType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();

            return $this->redirectToRoute('accounts_index');
        }

        return $this->render('accounts/new.html.twig', [
            'account' => $account,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="accounts_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accounts $account): Response
    {
        $form = $this->createForm(AccountsType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accounts_index');
        }

        return $this->render('accounts/edit.html.twig', [
            'account' => $account,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accounts_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Accounts $account): Response
    {
        if ($this->isCsrfTokenValid('delete'.$account->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($account);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accounts_index');
    }
}
