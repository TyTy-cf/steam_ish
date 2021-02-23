<?php


namespace App\Controller;


use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountsController.php
 *
 * @author Kevin Tourret
 */
class AccountsController extends AbstractController
{

    /**
     * @Route("/", name="index_account")
     * @param AccountRepository $repoAccount
     * @return Response
     */
    public function index(AccountRepository $repoAccount): Response {
        return $this->render('account_index.html.twig', [
            'accounts' => $repoAccount->findByDomain('gmail'),
        ]);
    }

}
