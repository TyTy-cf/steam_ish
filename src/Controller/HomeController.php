<?php


namespace App\Controller;


use App\Form\Filter\AccountFilterType;
use App\Form\Filter\GameFilterType;
use App\Repository\GamesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdaterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/", name="store")
     *
     * @param Request $request
     * @param GamesRepository $gamesRepository
     * @param PaginatorInterface $paginator
     * @param FilterBuilderUpdaterInterface $builderUpdater
     * @return RedirectResponse
     */
    public function home(
        Request $request,
        GamesRepository $gamesRepository,
        PaginatorInterface $paginator,
        FilterBuilderUpdaterInterface $builderUpdater
    ): Response {
        $qb = $gamesRepository->queryAllGames();

        $filterForm = $this->createForm(GameFilterType::class, null, [
            'method' => 'GET',
        ]);

        if ($request->query->has($filterForm->getName())) {
            $filterForm->submit($request->query->get($filterForm->getName()));
            $builderUpdater->addFilterConditions($filterForm, $qb);
        }

        $games = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            9,
            [
                'wrap-queries' => true,
            ]
        );

        return $this->render('store.html.twig', [
            'games' => $games,
            'filters' => $filterForm->createView(),
        ]);
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
