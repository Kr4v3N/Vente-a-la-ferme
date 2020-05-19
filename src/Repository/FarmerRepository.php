<?php

namespace App\Repository;

use App\Entity\Farmer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Farmer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Farmer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Farmer[]    findAll()
 * @method Farmer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FarmerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Farmer::class);
    }

    /**
     * @return Farmer[] Returns an array of Farmer objects
     */

    public function farmWithSamePostalCode($value)
    {
        return $this->createQueryBuilder('f')
            ->Where("f.postalCode LIKE :val")
            ->setParameter('val',$value . '%')
            ->orderBy('f.id', 'ASC')
            //->setMaxResults(6)
            ->getQuery()
            ->getResult()
            ;
    }

     /**
      * @return Farmer[] Returns an array of Farmer objects
      */

    public function farmBySearch($value)
    {
        return $this->createQueryBuilder('f')
            ->where('f.city LIKE :val')
            ->orWhere('f.postalCode LIKE :val')
            ->orWhere('f.farmName LIKE :val')
            ->setParameter('val',  $value . '%')
            ->orderBy('f.id', 'ASC')
            //->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Farmer[] Returns an array of Farmer objects
     */
    public function farmMultisearch($choice, $categoryId)
    {
        $qb = $this->createQueryBuilder('f');

        if ($choice !== null) {
            $qb->andWhere('f.city LIKE :val OR f.postalCode LIKE :val OR f.farmName LIKE :val')
                ->setParameter('val',  $choice . '%');
        }

        if ($categoryId !== null) {
            $qb->leftJoin('f.productFarmers', 'pf')
                ->leftJoin('pf.product', 'p')
                ->leftJoin('p.category', 'c')
                ->andWhere('c.id = :id')
                ->setParameter('id',  $categoryId);
        }

        $results = $qb->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $results;
    }

    /**
     * @return Farmer[] registered during the last 7 days
     */
    public function lastRegisteredFarmers($now, $date)
    {
        return $this->createQueryBuilder('f')
            ->where('f.createAt WHERE :val BETWEEN :now AND :oneWeek')
            ->setParameter('val', $now)
            ->setParameter('val', $date)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Farmer[] Returns an array of Farmer objects
     */

    public function farmByCategory($value)
    {
//        $sql = "SELECT * FROM farmer f
//                  JOIN product_farmer pf on f.id = pf.farmer_id
//                  JOIN product p on pf.product_id = p.id
//                  WHERE p.category_id = $value";
//
//        $em = $this->_em;
//        $stmt = $em->getConnection()->prepare($sql);
//        $stmt->execute();
//        return $stmt->fetchAll();

        //tableau d'objet

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT f
                 FROM App\Entity\Farmer f
                    JOIN f.productFarmers pf
                  JOIN pf.product p
                  WHERE p.category = :value"
        )->setParameter('value', $value);

            return $query->execute();

    }


    public function countFarmers()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(id) FROM farmer;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function countLastFarmers()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT COUNT(user.first_name) FROM role_user INNER JOIN role ON role_user.role_id=role.id INNER JOIN user ON user.id=role_user.user_id WHERE role.title='ROLE_FARMER'AND create_at BETWEEN DATE_SUB(NOW(),INTERVAL 7 YEAR) AND DATE(NOW());";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function countFavorites()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(farmer_id) FROM farmer_consumer;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

}
