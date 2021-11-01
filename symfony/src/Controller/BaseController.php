<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected function renderErrorPage(): Response
    {
        return $this->render('library/error-404.html.twig');
    }
}