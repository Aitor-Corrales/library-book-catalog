<?php

namespace App\Service;

use App\Entity\BookEditionLang;

class SearchService
{
    private BookManagementService $bookManagementService;

    public function __construct(BookManagementService $bookManagementService)
    {
        $this->bookManagementService = $bookManagementService;
    }

    /**
     * @return BookEditionLang[]
     * Returns an array of BookEditionLangs that matches the criteria.
     */
    public function getBookEditionLangsByCriteria(string $criteria): array
    {
        return $this->bookManagementService->getBookEditionLangsByCriteria($criteria);
    }

}