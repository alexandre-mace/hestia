<?php

namespace App\Repository;

use App\Entity\SiteMaterialsExample;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SiteMaterialsExample|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteMaterialsExample|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteMaterialsExample[]    findAll()
 * @method SiteMaterialsExample[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteMaterialsExampleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SiteMaterialsExample::class);
    }

    // /**
    //  * @return SiteMaterialsExample[] Returns an array of SiteMaterialsExample objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SiteMaterialsExample
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
