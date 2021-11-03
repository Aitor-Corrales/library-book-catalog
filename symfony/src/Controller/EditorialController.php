<?php

namespace App\Controller;

use App\Repository\EditorialRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorialController extends BaseController
{
    private EditorialRepository $editorialRepository;
    private BookManagementService $bookManagementService;

    public function __construct(EditorialRepository $editorialRepository, BookManagementService $bookManagementService)
    {
        $this->editorialRepository = $editorialRepository;
        $this->bookManagementService = $bookManagementService;
    }

    /**
     * @Route("/editorials", name="editorialList")
     */
    public function editorialList(): Response
    {
        return $this->render('library/editorials/editorial-list.html.twig', [
            'editorials' => $this->editorialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/editorial/{id}", name="editorial")
     */
    public function editorialPage(int $id): Response
    {
        $editorial = $this->editorialRepository->find($id);
        if ($editorial) {
            $bookEditionLangs = $this->bookManagementService->getBookEditionLangsByBookEditions($editorial->getBookEditions());
            return $this->render('library/editorials/editorial.html.twig', [
                'editorial' => $editorial,
                'toShowBooks' => $bookEditionLangs,
            ]);
        }
        return $this->renderErrorPage();
    }
}