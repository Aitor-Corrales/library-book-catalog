<?php

namespace App\Controller\Books;

use App\Controller\BaseController;
use App\Repository\BookEditionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookEditionController extends BaseController
{

    private BookEditionRepository $bookEditionRepository;

    public function __construct(BookEditionRepository $bookEditionRepository)
    {
        $this->bookEditionRepository = $bookEditionRepository;
    }

    /**
     * @Route("/book-edition/{id}", name="bookEdition")
     */
    public function bookEdition(int $id): Response
    {
        $bookEdition = $this->bookEditionRepository->find($id);
        if ($bookEdition) {
            return $this->render('library/books/book-edition.html.twig', [
                'bookEdition' => $bookEdition,
                'toShowBooks' => $bookEdition->getBookEditionLangs(),
            ]);
        }
        return $this->renderErrorPage();
    }
}