<?php

namespace App\Service;

use App\Entity\BookEditionLang;
use App\Repository\BookEditionLangRepository;

class SearchService
{
    private BookEditionLangRepository $bookEditionLangRepository;

    public function __construct(BookEditionLangRepository $bookEditionLangRepository)
    {
        $this->bookEditionLangRepository = $bookEditionLangRepository;
    }

    /**
     * @return BookEditionLang[]
     * Returns an array of BookEditionLangs that matches the criteria.
     */
    public function getBookEditionLangsByCriteria(string $criteria): array
    {
        return $this->bookEditionLangRepository->getBookEditionLangsByTextCriteria($criteria);
    }

}