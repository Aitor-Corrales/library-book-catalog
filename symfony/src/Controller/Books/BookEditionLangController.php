<?php

namespace App\Controller\Books;

use App\Controller\BaseController;
use App\Entity\Book;
use App\Entity\BookEdition;
use App\Entity\BookEditionLang;
use App\Model\Enumerator\Language;
use App\Repository\BookEditionLangRepository;
use App\Repository\EditorialRepository;
use App\Repository\EditorRepository;
use App\Repository\TranslatorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookEditionLangController extends BaseController
{

    private BookEditionLangRepository $bookEditionLangRepository;
    private TranslatorRepository $translatorRepository;
    private EditorialRepository $editorialRepository;
    private EditorRepository $editorRepository;

    public function __construct(
        BookEditionLangRepository $bookEditionLangRepository,
        TranslatorRepository      $translatorRepository,
        EditorialRepository       $editorialRepository,
        EditorRepository          $editorRepository
    )
    {
        $this->bookEditionLangRepository = $bookEditionLangRepository;
        $this->translatorRepository = $translatorRepository;
        $this->editorialRepository = $editorialRepository;
        $this->editorRepository = $editorRepository;
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
     * @Route("/book-edition-lang/{id}", name="bookEditionLang")
     */
    public function bookEditionLangPage(string $id): Response
    {
        $bookEditionLang = $this->bookEditionLangRepository->find($id);
        if ($bookEditionLang) {
            return $this->render('library/books/book-edition-lang.html.twig', [
                'bookEditionLang' => $bookEditionLang,
            ]);
        }
        return $this->renderErrorPage();

    }

    /**
     * @Route("/create/book-edition-lang", name="createBookEditionLang")
     */
    public function createBookEditionLang(Request $request): Response
    {
        if ($request->get('_create')) {
            if ($this->requiredFieldsFilled($request)) {
                $bookEditionLang = $this->createBook($request);
                return $this->render('library/books/book-edition-lang.html.twig', [
                    'bookEditionLang' => $bookEditionLang,
                ]);
            }
        }
        return $this->render('library/books/create-book-edition-lang.html.twig', [
            'translators' => $this->translatorRepository->findAll(),
            'editorials' => $this->editorialRepository->findAll(),
            'editors' => $this->editorRepository->findAll(),
            'languages' => Language::getEnumList(),
        ]);
    }

    /**
     * @Route("/modify/book-edition-lang/{id}", name="modifyBookEditionLang")
     */
    public function modifyBookEditionLang(string $id): Response
    {
        $bookEditionLang = $this->bookEditionLangRepository->find($id);
        $bookEdition = $bookEditionLang->getBookEdition();
        return $this->render('library/books/book-edition.html.twig', [
            'bookEdition' => $bookEdition,
        ]);
    }

    /**
     * @Route("/delete/book-edition-lang/{id}", name="deleteBookEditionLang")
     */
    public function deleteBookEditionLang(string $id): Response
    {
        $bookEditionLang = $this->bookEditionLangRepository->find($id);
        if ($bookEditionLang) {
            $bookEdition = $bookEditionLang->getBookEdition();
            $entityManager = $this->getDoctrine()->getManager();
            try {
                $entityManager->remove($bookEditionLang);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->render('library/books/book-edition-lang.html.twig', [
                    'bookEditionLang' => $bookEditionLang,
                    'error' => $e->getMessage()
                ]);
            }
            return $this->render('library/books/book-edition.html.twig', [
                'bookEdition' => $bookEdition,
            ]);
        }
        return $this->renderErrorPage();
    }

    private function createBook(Request $request): BookEditionLang
    {
        $book = new Book();
        $bookEdition = new BookEdition();
        $bookEditionLang = new BookEditionLang();
        $entityManager = $this->getDoctrine()->getManager();
        $bookEdition->setBook($book);
        $bookEdition->setEdition($request->get('_edition'));
        $bookEdition->setEditorial($this->editorialRepository->find($request->get('_editorial')));
        $bookEdition->setEditor($this->editorRepository->find($request->get('_editor')));
        $bookEditionLang->setTitle($request->get('_title'));
        $bookEditionLang->setSummary($request->get('_summary'));
        $bookEditionLang->setBookEdition($bookEdition);
        $bookEditionLang->setBookEdition($bookEdition);
        $bookEditionLang->setTranslator($this->translatorRepository->find($request->get('_translator')));
        $bookEditionLang->setLanguage($request->get('_language'));
        $entityManager->persist($book);
        $entityManager->persist($bookEdition);
        $entityManager->persist($bookEditionLang);
        $entityManager->flush();
        return $bookEditionLang;
    }

    private function requiredFieldsFilled(Request $request): bool
    {
        return !!$request->get('_title') &&
            !!$request->get('_summary') &&
            !!$request->get('_translator') &&
            !!$request->get('_editorial') &&
            !!$request->get('_language');
    }
}