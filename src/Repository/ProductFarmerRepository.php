<?php

namespace App\Repository;

use App\Entity\ProductFarmer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductFarmer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductFarmer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductFarmer[]    findAll()
 * @method ProductFarmer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductFarmerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductFarmer::class);
    }

    // /**
    //  * @return ProductFarmer[] Returns an array of ProductFarmer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductFarmer
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
