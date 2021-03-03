<?php


namespace App\Controller;

use App\Entity\Genres;
use App\Repository\GamesRepository;
use App\Repository\GenreRepository;
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
     * @param GenreRepository $genreRepository
     * @return Response
     */
    public function showGames(
        Request $request,
        Genres $genres,
        GamesRepository $gamesRepository
    ) {
        $games = $gamesRepository->findGenreById($request->get('id'));


        return $this->render('games/genres.html.twig', [
            'games' => $games,
            'genre' => $genres,
        ]);
    }
}
