<?php

namespace App\Repository;

use App\Entity\BookEdition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookEdition|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookEdition|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookEdition[]    findAll()
 * @method BookEdition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookEditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookEdition::class);
    }

    // /**
    //  * @return BookEdition[] Returns an array of BookEdition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookEdition
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
