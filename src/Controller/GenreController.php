<?php


namespace App\Controller;

use App\Entity\Genres;
use App\Repository\GamesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GenresController.php
 *
 * @author Kevin Tourret
 */
class GenreController extends AbstractController
{

    /**
     * @Route("/genre/{id}", name="genres")
     *
     * @param Genre $genre
     * @param Request $request
     * @param GamesRepository $gamesRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function showGames(
        Request $request,
        Genres $genres,
        GamesRepository $gamesRepository,
        PaginatorInterface $paginator
    ) {
        $qb = $gamesRepository->findGenreById($request->get('id'));


        $games = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            3
        );


        return $this->render('games/genres.html.twig', [
            'games' => $games,
            'genre' => $genres,
        ]);
    }
}
