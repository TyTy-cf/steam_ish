<?php

namespace App\Repository;

use App\Entity\Comments;
use App\Entity\Games;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comments[]    findAll()
 * @method Comments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comments::class);
    }

    /**
     * @param Games $game
     * @param bool $isUpVote
     * @return int|mixed|string
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getTotalVotesByGames(Games $game, bool $isUpVote = true) {
        $qb = $this->createQueryBuilder('comments');
        if ($isUpVote) {
            $qb->select('SUM(comments.upVotes)');
        } else {
            $qb->select('SUM(comments.downVotes)');
        }
        return $qb->join('comments.game', 'game')
            ->andWhere('game = :game')
            ->setParameter('game', $game)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @param Games $game
     * @return QueryBuilder
     */
    public function queryCommentsByGame(Games $game): QueryBuilder
    {
        return $this->createQueryBuilder('comments')
            ->select('comments', 'account')
            ->join('comments.account', 'account')
            ->join('comments.game', 'game')
            ->andWhere('comments.game = :game')
            ->setParameter('game', $game)
            ->orderBy('comments.createAt', 'DESC')
        ;
    }

    /*
    public function findOneBySomeField($value): ?Comments
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
