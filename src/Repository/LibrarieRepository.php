<?php

namespace App\Repository;

use App\Entity\Libraries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Libraries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Libraries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Libraries[]    findAll()
 * @method Libraries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibrarieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Libraries::class);
    }

    // /**
    //  * @return Librarie[] Returns an array of Librarie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Librarie
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
