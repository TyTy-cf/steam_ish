<?php

namespace App\Repository;

use App\Entity\Libraries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
            ->select('librarie', 'game', 'account')
            ->join('librarie.account', 'account')
            ->join('librarie.game', 'game')
            ->andWhere('librarie.account = :account')
            ->setParameter('account', $account)
            ->orderBy('librarie.installed', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     *  SELECT sum(libraries.game_time), accounts.name
     *  FROM libraries
     *  JOIN accounts
     *  ON accounts.id = libraries.account_id
     *  GROUP BY accounts.name
     *
     * @param $account
     * @return int|mixed|string
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getTotalGameTimeByAccount($account) {
        return $this->createQueryBuilder('libraries')
            ->select('SUM(libraries.gameTime)')
            ->join('libraries.account', 'account')
            ->andWhere('libraries.account = :account')
            ->setParameter('account', $account)
            ->getQuery()
            ->getSingleScalarResult()
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
