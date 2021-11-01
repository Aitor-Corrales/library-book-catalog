<?php

namespace App\Service;

use App\Repository\BookEditionLangRepository;

class UserService
{

    public function __construct(BookEditionLangRepository $bookEditionLangRepository)
    {
        $this->bookEditionLangRepository = $bookEditionLangRepository;
    }

}