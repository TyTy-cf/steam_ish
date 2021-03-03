<?php

namespace App\Repository;

use App\Entity\Genres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Genres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genres[]    findAll()
 * @method Genres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genres::class);
    }

    /**
     * @param int $id
     * @return int|mixed|string|null
     * @throws NonUniqueResultException
     */
    public function findGenreById(int $id)
    {
        return $this->createQueryBuilder('genre')
            ->select('genre','games')
            ->join('genre.games', 'games')
            ->andWhere('genre.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Genre[] Returns an array of Genre objects
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
    public function findOneBySomeField($value): ?Genre
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
