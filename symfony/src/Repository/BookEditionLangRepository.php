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
     * Returns an array of randomly selected BookEditionLangs
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
     * Returns an array of BookEditionLangs that matches with $criteria parameter. It takes into account the number of rows to return and the batch number
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

    /**
     * @param int[] $bookIds
     * @return BookEditionLang[]
     * Returns every BookEditionLang whose book is one of those passed as parameter
     */
    public function findAllByBooks(array $bookIds): array
    {
        return $this->createQueryBuilder('bookEditionLang')
            ->leftJoin('bookEditionLang.bookEdition', 'bookEdition')
            ->leftJoin('bookEdition.book', 'book')
            ->andWhere('book.id IN (:bookIds)')
            ->setParameter('bookIds', $bookIds)
            ->addOrderBy('bookEditionLang.creationDate', 'DESC')
            ->addOrderBy('bookEditionLang.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int[] $bookEditionIds
     * @return BookEditionLang[]
     * Returns every BookEditionLang whose bookEdition is one of those passed as parameter
     */
    public function findAllByBookEditions(array $bookEditionIds): array
    {
        return $this->createQueryBuilder('bookEditionLang')
            ->leftJoin('bookEditionLang.bookEdition', 'bookEdition')
            ->andWhere('bookEdition.id IN (:bookEditionIds)')
            ->setParameter('bookEditionIds', $bookEditionIds)
            ->addOrderBy('bookEditionLang.creationDate', 'DESC')
            ->addOrderBy('bookEditionLang.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
