<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends BaseController
{

    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @Route("/authors", name="authorList")
     */
    public function index(): Response
    {
        return $this->render('library/authors/author-list.html.twig', [
            'authors' => $this->authorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/author-work/{id}", name="authorWork")
     */
    public function authorWork(int $id): Response
    {
        $author = $this->authorRepository->find($id);
        if ($author) {
            return $this->render('library/authors/author-work.html.twig', [
                'author' => $author,
            ]);
        }
        return $this->renderErrorPage();
    }
}