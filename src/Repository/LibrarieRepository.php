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

    /**
     * @param $account
     * @return Libraries[] Returns an array of Librarie objects
     */
    public function findLibrariesByAccount($account): array
    {
        return $this->createQueryBuilder('librarie')
            ->join('librarie.account', 'account')
            ->join('librarie.game', 'game')
            ->andWhere('librarie.account = :account')
            ->setParameter('account', $account)
            ->orderBy('game.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

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
