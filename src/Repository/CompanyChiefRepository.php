<?php

namespace App\Repository;

use App\Entity\CompanyChief;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyChief|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyChief|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyChief[]    findAll()
 * @method CompanyChief[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyChiefRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyChief::class);
    }

    // /**
    //  * @return CompanyChief[] Returns an array of CompanyChief objects
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

    /*
    public function findOneBySomeField($value): ?CompanyChief
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
