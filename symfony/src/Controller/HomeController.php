<?php

namespace App\Controller;

use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{

    private BookManagementService $bookManagementService;

    public function __construct(BookManagementService $bookManagementService)
    {
        $this->bookManagementService = $bookManagementService;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('library/home.html.twig', [
            'toShowBooks' => $this->bookManagementService->getBookEditionLangsHome(),
        ]);
    }
}