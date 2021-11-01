<?php

namespace App\Controller\Books;

use App\Repository\BookEditionLangRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookEditionLangController extends AbstractController
{

    private BookEditionLangRepository $bookEditionLangRepository;

    public function __construct(BookEditionLangRepository $bookEditionLangRepository)
    {
        $this->bookEditionLangRepository = $bookEditionLangRepository;
    }

    /**
     * @Route("/book-edition-lang-list", name="bookEditionLangList")
     */
    public function bookEditionLangList(): Response
    {
        return $this->render('library/books/book-edition-lang-list.html.twig', [
            'toShowBooks' => $this->bookEditionLangRepository->findAll(),
        ]);
    }

    /**
     * @Route("/book-edition-lang/{id}", name="bookEditionLangPage")
     */
    public function bookEditionLangPage(string $id): Response
    {
        return $this->render('library/books/book-edition-lang.html.twig', [
            'bookEditionLang' => $this->bookEditionLangRepository->find($id),
        ]);
    }
}