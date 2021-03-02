<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController.php
 *
 * @author Kevin Tourret
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): RedirectResponse
    {
        return $this->redirectToRoute('accounts_index');
    }

    /**
     * @Route("/test", name="test")
     * @return Response
     */
    public function test() {
        return $this->render('souk/test.html.twig', [
            'name' => 'TwigDeTest@hotmail.de',
            'array' => [
                'IE' => 'C\'est nul',
                'chrome' => 'C\'est mieux',
                'MFF' => 'C\'est OK',
                'safari' => 'Ca existe ?',
            ],
            'number' => -10,
        ]);
    }
}
