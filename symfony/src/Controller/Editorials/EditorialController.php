<?php

namespace App\Controller\Editorials;

use App\Controller\BaseController;
use App\Repository\EditorialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorialController extends BaseController
{
    private EditorialRepository $editorialRepository;

    public function __construct(EditorialRepository $editorialRepository)
    {
        $this->editorialRepository = $editorialRepository;
    }

    /**
     * @Route("/editorials", name="editorialList")
     */
    public function editorialList(): Response
    {
        return $this->render('library/editorial-list.html.twig', [
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
            return $this->render('library/editorials/editorial.html.twig', [
                'editorial' => $editorial,
            ]);
        }
        return $this->renderErrorPage();
    }
}