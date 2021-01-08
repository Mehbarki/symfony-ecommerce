<?php

namespace App\Repository;

use App\Entity\ShopContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShopContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopContent[]    findAll()
 * @method ShopContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopContent::class);
    }

    // /**
    //  * @return ShopContent[] Returns an array of ShopContent objects
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
    public function findOneBySomeField($value): ?ShopContent
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
