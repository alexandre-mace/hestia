<?php

namespace App\Repository;

use App\Entity\Site;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Site|null find($id, $lockMode = null, $lockVersion = null)
 * @method Site|null findOneBy(array $criteria, array $orderBy = null)
 * @method Site[]    findAll()
 * @method Site[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Site::class);
    }

    public function findBestSites()
    {
        return $this->createQueryBuilder('s')
            ->addSelect('m')
            ->join("s.manager","m")
            ->orderBy('s.recyclingRate', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllLimited($managerId)
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->andWhere('s.manager = :id')
            ->setParameter('id', $managerId)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }
    public function getLabeledSite($managerId)
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->where('s.recyclingRate >= 70')
            ->andWhere('s.manager = :id')
            ->setParameter('id', $managerId)
            ->orderBy('s.recyclingRate', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return Site[] Returns an array of Site objects
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
    public function findOneBySomeField($value): ?Site
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
