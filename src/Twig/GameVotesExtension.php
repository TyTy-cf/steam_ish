<?php


namespace App\Twig;


use App\Entity\Games;
use App\Repository\CommentsRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class GameVotesExtension.php
 *
 * @author Kevin Tourret
 */
class GameVotesExtension extends AbstractExtension
{

    /**
     * @var CommentsRepository $commentsRepository,
     */
    private $commentsRepository;

    /**
     * GameVotesExtension constructor.
     * @param CommentsRepository $commentsRepository
     */
    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('total_votes', [$this, 'getTotalVotesByGames']),
        ];
    }

    /**
     * @param Games $game
     * @param bool $isUpVote
     * @return int|mixed|string
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getTotalVotesByGames(Games $game, bool $isUpVote = true) {
        return $this->commentsRepository->getTotalVotesByGames($game, $isUpVote);
    }

}
