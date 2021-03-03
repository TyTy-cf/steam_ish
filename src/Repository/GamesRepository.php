<?php

namespace App\Repository;

use App\Entity\Games;
use App\Entity\Genres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Games|null find($id, $lockMode = null, $lockVersion = null)
 * @method Games|null findOneBy(array $criteria, array $orderBy = null)
 * @method Games[]    findAll()
 * @method Games[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Games::class);
    }

    /**
     * @param int $id
     * @return int|mixed|string|null
     * @throws NonUniqueResultException
     */
    public function findGameById(int $id)
    {
        return $this->createQueryBuilder('g')
            ->select('g','genres', 'languages')
            ->join('g.genres', 'genres')
            ->join('g.languages', 'languages')
            ->andWhere('g.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param Genres|null $genre
     * @return QueryBuilder
     */
    public function queryGameByGenre(?Genres $genre): QueryBuilder
    {
        return $this->createQueryBuilder('games')
            ->select('games','genres_all', 'languages')
            ->join('games.genres', 'genres')
            ->join('games.genres', 'genres_all')
            ->join('games.languages', 'languages')
            ->where('genres = :genre')
            ->setParameter('genre', $genre)
        ;
    }

    /**
     * @return QueryBuilder
     */
    public function queryAllGames(): QueryBuilder
    {
        return $this->createQueryBuilder('games')
            ->select('games','genres', 'languages')
            ->join('games.genres', 'genres')
            ->join('games.languages', 'languages')
            ->orderBy('games.publishedAt', 'DESC')
        ;
    }

    // /**
    //  * @return Games[] Returns an array of Games objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Games
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
