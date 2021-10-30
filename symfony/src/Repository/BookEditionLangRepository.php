<?php

namespace App\Repository;

use App\Entity\BookEditionLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookEditionLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookEditionLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookEditionLang[]    findAll()
 * @method BookEditionLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookEditionLangRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookEditionLang::class);
    }

    /**
     * @param int $count
     * @return BookEditionLang[]
     * returns an array of randomly selected BookEditionLangs
     */
    public function getRandomBooks(int $count): array
    {
        return $this->createQueryBuilder('bookEditionLangs')
            ->addSelect('RANDOMIZE() as HIDDEN rand')
            ->addOrderBy('rand')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $searchTerm
     * @param int $paginationNumber
     * @param int $numberOfRows
     * @return BookEditionLang[]
     * returns an array of BookEditionLangs that matches with $criteria parameter. It takes into account the number of rows to return and the batch number
     */
    public function getBookEditionLangsByTextCriteria(string $searchTerm, int $paginationNumber = 0, int $numberOfRows = 10): array
    {
        return $this->createQueryBuilder('bookEditionLang')
            ->andWhere('bookEditionLang.title LIKE :searchTerm')
            ->setParameter('searchTerm', "%$searchTerm%")
            ->addOrderBy('bookEditionLang.creationDate', 'DESC')
            ->addOrderBy('bookEditionLang.id', 'ASC')
            ->setFirstResult($paginationNumber)
            ->setMaxResults($numberOfRows)
            ->getQuery()
            ->getResult();
    }



//    /**
//     * @param string $criteria
//     * @return BookEditionLang[]
//     */
//    public function getBookEditionLangsByTextCriteria(string $criteria): array
//    {
//        $entityManager = $this->getEntityManager();
//        $query = $entityManager->createQuery(
//            'SELECT bel
//            FROM App\Entity\BookEditionLang bel
//            WHERE (
//                SELECT
//            )
//            ORDER BY p.price ASC'
//        )->setParameter('price', $price);
//
//        // returns an array of Product objects
//        return $query->getResult();
//    }


}
