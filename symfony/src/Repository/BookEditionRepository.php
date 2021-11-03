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

    /**
     * @param string $edition
     * @param int $bookId
     * @return BookEdition|null
     * Returns a bookEdition with first param's edition number and with second param's book as parent
     */
    public function findByEditionAndBookId(string $edition, int $bookId): ?BookEdition
    {
        $bookEdition = $this->createQueryBuilder('bookEdition')
            ->leftJoin('bookEdition.book', 'book')
            ->andWhere('bookEdition.edition = :edition')
            ->andWhere('book.id = :bookId')
            ->setParameter('edition', $edition)
            ->setParameter('bookId', $bookId)
            ->getQuery()
            ->getResult();
        return count($bookEdition) === 1 ? $bookEdition[0] : null;
    }

}
