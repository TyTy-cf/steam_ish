<?php

namespace App\Repository;

use App\Entity\Accounts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Accounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accounts[]    findAll()
 * @method Accounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accounts::class);
    }

    public function queryAll(): QueryBuilder
    {
        return $this->createQueryBuilder('account')
            ->select('account', 'libraries')
            ->leftJoin('account.libraries', 'libraries')
            ->orderBy('account.name')
        ;
    }

    /**
     * @param string $domain
     * @return int|mixed|string
     */
    public function findByDomain(string $domain)
    {
        return $this->createQueryBuilder('account')
            ->andWhere('account.email LIKE :domain')
            ->setParameter('domain', '%' . $domain .'%')
            ->orderBy('account.name', 'ASC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return Account[] Returns an array of Account objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Account
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
