<?php

namespace App\Service;

use App\Entity\Book;
use App\Entity\BookEdition;
use App\Entity\BookEditionLang;
use App\Repository\BookEditionLangRepository;
use phpDocumentor\Reflection\Types\Collection;

class BookManagementService
{
    private BookEditionLangRepository $bookEditionLangRepository;

    public function __construct(BookEditionLangRepository $bookEditionLangRepository)
    {
        $this->bookEditionLangRepository = $bookEditionLangRepository;
    }

    /**
     * @return BookEditionLang[]
     * Returns a stack of 10 random books in order to show them in the Home page
     */
    public function getBookEditionLangsHome(int $bookNumber = 10): array
    {
        return $this->bookEditionLangRepository->getRandomBooks($bookNumber);
    }

    /**
     * @return BookEditionLang[]
     * Returns an array of BookEditionLangs that matches the criteria.
     */
    public function getBookEditionLangsByCriteria(string $criteria): array
    {
        return $this->bookEditionLangRepository->getBookEditionLangsByTextCriteria($criteria);
    }

    /**
     * @param Book[]|Collection $books
     * @return BookEditionLang[]
     */
    public function getBookEditionLangsByBooks($books): array
    {
        $bookIds = [];
        foreach ($books as $book)
            $bookIds[] = $book->getId();
        return $this->bookEditionLangRepository->findAllByBooks($bookIds);
    }

    /**
     * @param BookEdition[]|Collection $bookEditions
     * @return BookEditionLang[]
     */
    public function getBookEditionLangsByBookEditions($bookEditions): array
    {
        $bookEditionIds = [];
        foreach ($bookEditions as $bookEdition)
            $bookEditionIds[] = $bookEdition->getId();
        return $this->bookEditionLangRepository->findAllByBookEditions($bookEditionIds);
    }

}