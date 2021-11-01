<?php

namespace App\Controller\Editorials;

use App\Repository\EditorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorialController extends AbstractController
{
    private EditorialRepository $editorialRepository;

    public function __construct(EditorialRepository $editorialRepository)
    {
        $this->editorialRepository = $editorialRepository;
    }

    /**
     * @Route("/editorials", name="editorialList")
     */
    public function index(): Response
    {
        return $this->render('library/editorial-list.html.twig', [
            'editorials' => $this->editorialRepository,
        ]);
    }
}