<?php

namespace App\Repository\User;

use App\Entity\User\TwitterAuth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TwitterAuth|null find($id, $lockMode = null, $lockVersion = null)
 * @method TwitterAuth|null findOneBy(array $criteria, array $orderBy = null)
 * @method TwitterAuth[]    findAll()
 * @method TwitterAuth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TwitterAuthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TwitterAuth::class);
    }

    // /**
    //  * @return TwitterAuth[] Returns an array of TwitterAuth objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TwitterAuth
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
