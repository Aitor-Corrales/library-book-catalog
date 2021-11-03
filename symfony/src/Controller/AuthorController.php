<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends BaseController
{

    private AuthorRepository $authorRepository;
    private BookManagementService $bookManagementService;

    public function __construct(AuthorRepository $authorRepository, BookManagementService $bookManagementService)
    {
        $this->authorRepository = $authorRepository;
        $this->bookManagementService = $bookManagementService;
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
     * @Route("/author/{id}", name="author")
     */
    public function author(int $id): Response
    {
        $author = $this->authorRepository->find($id);
        if ($author) {
            $bookEditionLangs = $this->bookManagementService->getBookEditionLangsByBooks($author->getBooks());
            return $this->render('library/authors/author.html.twig', [
                'author' => $author,
                'toShowBooks' => $bookEditionLangs,
            ]);
        }
        return $this->renderErrorPage();
    }
}