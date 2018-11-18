<?php

namespace App\Repository;

use App\Entity\SiteMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SiteMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteMaterial[]    findAll()
 * @method SiteMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteMaterialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SiteMaterial::class);
    }

    // /**
    //  * @return SiteMaterial[] Returns an array of SiteMaterial objects
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
    public function findOneBySomeField($value): ?SiteMaterial
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
