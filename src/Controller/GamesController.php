<?php


namespace App\Controller;


use App\Entity\Genres;
use App\Repository\CommentsRepository;
use App\Repository\GamesRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\NonUniqueResultException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GamesController.php
 * @Route("/games")
 *
 * @author Kevin Tourret
 */
class GamesController extends AbstractController
{

    /**
     * @var GamesRepository $gamesRepository
     */
    private $gamesRepository;

    /**
     * @var CommentsRepository $commentsRepository,
     */
    private $commentsRepository;

    /**
     * @var PaginatorInterface $paginator
     */
    private $paginator;

    /**
     * @var GenreRepository $genreRepository
     */
    private $genreRepository;

    /**
     * GamesController constructor.
     * @param GamesRepository $gamesRepository
     * @param CommentsRepository $commentsRepository
     * @param GenreRepository $genreRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        GamesRepository $gamesRepository,
        CommentsRepository $commentsRepository,
        GenreRepository $genreRepository,
        PaginatorInterface $paginator
    ) {
        $this->gamesRepository = $gamesRepository;
        $this->commentsRepository = $commentsRepository;
        $this->genreRepository = $genreRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/{id}/show", name="games_show")
     *
     * @param Request $request
     * @return Response
     * @throws NonUniqueResultException
     */
    public function show(
        Request $request
    ): Response {
        $game = $this->gamesRepository->findGameById($request->get('id'));

        $qb = $this->commentsRepository->queryCommentsByGame($game);

        $comments = $this->paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('games/show.html.twig', [
            'game' => $game,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/genre/{id}", name="games_genre")
     *
     * @param Request $request
     * @param Genres $genre
     * @return Response
     */
    public function gamesGenre(
        Request $request,
        Genres $genre
    ) {
        $qb = $this->gamesRepository->queryGameByGenre($genre);

        $games = $this->paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('games/games_by_genre.html.twig', [
            'genre' => $genre,
            'games' => $games,
        ]);
    }
}
