<?php

namespace App\Repository;

use App\Entity\Candidat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use function PHPUnit\Framework\isTrue;

/**
 * @method Candidat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidat[]    findAll()
 * @method Candidat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Candidat::class);
        $this->entityManager = $entityManager;
    }

    // /**
    //  * @return Candidat[] Returns an array of Candidat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
//         /**
//      * Returns sum of "Montant" par date
//      * @return void 
//      */
//     public function sumCandidatCertifie(){
//         $query = $this->createQueryBuilder('c')
//                ->select('count(c.id) as somme')
//                ->where('c.certified = True' )
              
//         ;
//         return $query->getQuery()->getResult();
       
//    }
    /*
    public function findOneBySomeField($value): ?Candidat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

       /**
      * @return Candidat[] Returns an array of Candidat objects
      */
    public function ChangeArchive(Candidat $candidat){

        if ($candidat->getIsarchived()==true) {
            $candidat->setIsarchived(false);
        }else {
            $candidat->setIsarchived(True);
        }
        $this->entityManager->persist($candidat);
        $this->entityManager->flush();
        return $candidat;

    }
}
