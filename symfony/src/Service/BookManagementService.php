<?php

namespace App\Service;

use App\Entity\BookEditionLang;
use App\Repository\BookEditionLangRepository;

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
    public function getBooksEditionLangHome(int $bookNumber = 10): array
    {
        return $this->bookEditionLangRepository->getRandomBooks($bookNumber);
    }

}