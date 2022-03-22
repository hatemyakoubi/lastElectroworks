<?php

namespace App\Repository;

use App\Entity\Delivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Delivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delivre[]    findAll()
 * @method Delivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DelivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delivre::class);
    }

    // /**
    //  * @return Delivre[] Returns an array of Delivre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Delivre
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
