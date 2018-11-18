<?php

namespace App\Repository;

use App\Entity\SiteMaterialListExample;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SiteMaterialListExample|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteMaterialListExample|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteMaterialListExample[]    findAll()
 * @method SiteMaterialListExample[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteMaterialListExampleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SiteMaterialListExample::class);
    }

    // /**
    //  * @return SiteMaterialListExample[] Returns an array of SiteMaterialListExample objects
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
    public function findOneBySomeField($value): ?SiteMaterialListExample
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
