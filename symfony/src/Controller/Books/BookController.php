<?php

namespace App\Controller\Books;

use App\Controller\BaseController;
use App\Repository\BookRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends BaseController
{

    private BookRepository $bookRepository;
    private BookManagementService $bookManagementService;

    public function __construct(BookRepository $bookRepository, BookManagementService $bookManagementService)
    {
        $this->bookRepository = $bookRepository;
        $this->bookManagementService = $bookManagementService;
    }

    /**
     * @Route("/book/{id}", name="book")
     */
    public function bookEdition(int $id): Response
    {
        $book = $this->bookRepository->find($id);
        if ($book) {
            $bookEditionLangs = $this->bookManagementService->getBookEditionLangsByBookEditions($book->getBookEditions());
            return $this->render('library/books/book.html.twig', [
                'book' => $book,
                'toShowBooks' => $bookEditionLangs,
            ]);
        }
        return $this->renderErrorPage();
    }
}