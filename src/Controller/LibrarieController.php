<?php


namespace App\Controller;


use App\Entity\Accounts;
use App\Repository\LibrarieRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LibrarieController.php
 *
 * @author Kevin Tourret
 */
class LibrarieController extends AbstractController
{

    /**
     * @Route("/accounts/{idAcc}/librarie", name="index_librarie")
     * @ParamConverter("account", options={"mapping": {
     *      "idAcc": "id"
     * }})
     *
     * @param Accounts $account
     * @param LibrarieRepository $librarieRepository
     * @return Response
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function index(
        Accounts $account,
        LibrarieRepository $librarieRepository
    ) {
        return $this->render('librarie_index.html.twig', [
            'account' => $account,
            'libraries' => $librarieRepository->findLibrariesByAccount($account),
            'totalGameTime' => $librarieRepository->getTotalGameTimeByAccount($account),
        ]);
    }

}
