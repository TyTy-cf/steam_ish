<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Form\AccountsType;
use App\Repository\AccountRepository;
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
     * @return Response
     */
    public function index(AccountRepository $accountRepository): Response
    {
        return $this->render('accounts/index.html.twig', [
            'accounts' => $accountRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="accounts_new", methods={"GET","POST"})
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
