<?php


namespace App\Controller;


use App\Repository\CommentsRepository;
use App\Repository\GamesRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GamesController.php
 *
 * @author Kevin Tourret
 */
class GamesController extends AbstractController
{

    /**
     * @Route("/games/{id}/show", name="games_show")
     *
     * @param Request $request
     * @param GamesRepository $gamesRepository
     * @param CommentsRepository $commentsRepository
     * @param PaginatorInterface $paginator
     * @return Response
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function show(
        Request $request,
        GamesRepository $gamesRepository,
        CommentsRepository $commentsRepository,
        PaginatorInterface $paginator
    ) {
        $game = $gamesRepository->findGameById($request->get('id'));

        $qb = $commentsRepository->queryCommentsByGame($game);

        $comments = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('games/show.html.twig', [
            'game' => $game,
            'totalUpVotes' => $commentsRepository->getTotalVotesByGames($game),
            'totalDownVotes' => $commentsRepository->getTotalVotesByGames($game, false),
            'comments' => $comments,
        ]);
    }
}
