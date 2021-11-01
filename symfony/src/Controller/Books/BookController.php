<?php

namespace App\Controller\Books;

use App\Controller\BaseController;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends BaseController
{

    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route("/book/{id}", name="book")
     */
    public function bookEdition(int $id): Response
    {
        $book = $this->bookRepository->find($id);
        if ($book) {
            return $this->render('library/books/book.html.twig', [
                'book' => $book,
            ]);
        }
        return $this->renderErrorPage();
    }
}