<?php

namespace App\Controller\Books;

use App\Controller\BaseController;
use App\Entity\Book;
use App\Entity\BookEdition;
use App\Entity\BookEditionLang;
use App\Model\Enumerator\Language;
use App\Repository\AuthorRepository;
use App\Repository\BookEditionLangRepository;
use App\Repository\BookEditionRepository;
use App\Repository\BookRepository;
use App\Repository\EditorialRepository;
use App\Repository\EditorRepository;
use App\Repository\TagRepository;
use App\Repository\TranslatorRepository;
use App\Service\ImageService;
use App\Service\RequestService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookEditionLangController extends BaseController
{
    private string $error = '';
    private Book $book;
    private BookEdition $bookEdition;

    private BookEditionLangRepository $bookEditionLangRepository;
    private BookEditionRepository $bookEditionRepository;
    private BookRepository $bookRepository;
    private TranslatorRepository $translatorRepository;
    private AuthorRepository $authorRepository;
    private EditorialRepository $editorialRepository;
    private EditorRepository $editorRepository;
    private TagRepository $tagRepository;
    private ImageService $imageService;
    private RequestService $requestService;

    public function __construct(
        BookEditionLangRepository $bookEditionLangRepository,
        BookEditionRepository     $bookEditionRepository,
        BookRepository            $bookRepository,
        TranslatorRepository      $translatorRepository,
        AuthorRepository          $authorRepository,
        EditorialRepository       $editorialRepository,
        EditorRepository          $editorRepository,
        TagRepository             $tagRepository,
        ImageService              $imageService,
        RequestService            $requestService
    )
    {
        $this->bookEditionLangRepository = $bookEditionLangRepository;
        $this->bookEditionRepository = $bookEditionRepository;
        $this->bookRepository = $bookRepository;
        $this->translatorRepository = $translatorRepository;
        $this->authorRepository = $authorRepository;
        $this->editorialRepository = $editorialRepository;
        $this->editorRepository = $editorRepository;
        $this->tagRepository = $tagRepository;
        $this->imageService = $imageService;
        $this->requestService = $requestService;
    }

    /**
     * @Route("/book-edition-lang-list", name="bookEditionLangList")
     */
    public function bookEditionLangList(): Response
    {
        return $this->render('library/books/book-edition-lang-list-index.html.twig', [
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
            if ($this->requiredFieldsFilled($request) &&
                $this->isInformationCoherentAndFilled($request)
            ) {
                $bookEditionLang = $this->_createBookEditionLang($request);
                return $this->render('library/books/book-edition-lang.html.twig', [
                    'bookEditionLang' => $bookEditionLang,
                ]);
            }
        }
        return $this->render('library/books/create-book-edition-lang.html.twig', [
            'error' => $this->error,
            'authors' => $this->authorRepository->findAll(),
            'translators' => $this->translatorRepository->findAll(),
            'editorials' => $this->editorialRepository->findAll(),
            'editors' => $this->editorRepository->findAll(),
            'languages' => Language::getEnumList(),
            'tags' => $this->tagRepository->findAll(),
            'edition' => $request->query->get('edition') ?? '',
            'authorSelected' => $request->query->get('authorId') ?? '',
            'translatorSelected' => $request->query->get('translatorId') ?? '',
            'editorialSelected' => $request->query->get('editorialId') ?? '',
            'languageSelected' => $request->query->get('languageCode') ?? '',
            'editorSelected' => $request->query->get('editorId') ?? '',
            'tagSelected' => $request->query->get('tagId') ?? '',
            'bookEditionId' => $request->query->get('bookEditionId') ?? '',
            'bookId' => $request->query->get('bookId') ?? '',
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
            return $this->redirectToRoute('bookEdition', [
                'id' => $bookEdition->getId(),
            ]);
        }
        return $this->renderErrorPage();
    }

    /**
     * @param Request $request
     * @return BookEditionLang
     * Creates a BookEditionLang with the data received from the request
     */
    private function _createBookEditionLang(Request $request): BookEditionLang
    {
        $bookEditionLang = new BookEditionLang();
        $entityManager = $this->getDoctrine()->getManager();
        $bookEditionLang->setTitle($request->get('_title'));
        $bookEditionLang->setSummary($request->get('_summary'));
        $bookEditionLang->setBookEdition($this->bookEdition);
        $bookEditionLang->setTranslator($this->translatorRepository->find($request->get('_translator')));
        $bookEditionLang->setLanguage($request->get('_language'));
        if (!$this->book->getId()) {
            $this->book->setAuthors($this->requestService->getAuthorsFromRequest($request));
            $this->book->setTags($this->requestService->getTagsFromRequest($request));
        }
        if (!$this->bookEdition->getId()) {
            $this->bookEdition->setEdition($request->get('_edition'));
            $this->bookEdition->setEditorial($this->editorialRepository->find($request->get('_editorial')));
            $this->bookEdition->setEditor($this->editorRepository->find($request->get('_editor')));
            $this->bookEdition->setBook($this->book);
        }
        $entityManager->persist($this->book);
        $entityManager->persist($this->bookEdition);
        $entityManager->persist($bookEditionLang);
        $entityManager->flush();
        return $bookEditionLang;
    }

    /**
     * @param Request $request
     * @return bool
     * Checks if every required field is filled
     */
    private function requiredFieldsFilled(Request $request): bool
    {
        $requiredFieldFilled = $request->get('_title') &&
            $request->get('_summary') &&
            $request->get('_translator') &&
            $request->get('_language');

        if ($requiredFieldFilled) {
            $this->book = $this->getOrCreateBookByRequest($request);
            $this->bookEdition = $this->getOrCreateBookEditionByRequest($request);
            if (!$this->book->getId())
                $requiredFieldFilled = $request->get('_authors');
            if (!$this->bookEdition->getId())
                $requiredFieldFilled = $request->get('_editorial') && $request->get('_editor');
        }
        if (!$requiredFieldFilled)
            $this->error = 'There are some missing fields';
        return $requiredFieldFilled;
    }

    /**
     * @param Request $request
     * @return bool
     * Checks if the information submitted by the user is not empty and coherent with the relations established in the database
     * PERFORMANCE_INFO: We could have stored the previous calls to the database to avoid calling it here but the cost of it is minimum
     */
    private function isInformationCoherentAndFilled(Request $request): bool
    {
        $isInformationCoherent = false;

        if (!$this->book->getId())
            if (!($isInformationCoherent = $this->requestService->getAuthorsFromRequest($request)))
                $this->error = 'There are no authors that match the ones sent in the request.';

        if (!$this->bookEdition->getId())
            if ($editor = $this->editorRepository->find($request->get('_editor'))) {
                if (!($isInformationCoherent = $editor->getEditorial()->getId() == $request->get('_editorial')))
                    $this->error = sprintf("The editor %s does not belong to this editorial", $editor->getName());
            } else
                $this->error = 'The editor you are trying to submit does not exist.';

        if ($isInformationCoherent && $request->get('_image'))
            if (!($isInformationCoherent = $this->imageService->imageHasAllowedExtension($request->get('_image'))))
                $this->error = 'The image you are trying to upload does not have an allowed extension.';

        if (!$isInformationCoherent && !$this->error && $this->book->getId() && $this->bookEdition->getId())
            $isInformationCoherent = true;

        if (!$isInformationCoherent && !$this->error)
            $this->error = 'Something went wrong with your request.';

        return $isInformationCoherent;
    }

    /**
     * @param Request $request
     * @return Book
     * Returns a book object. If there is a book id specified in the request, and that book exists, it returns this book. Otherwise, it returns a new instance of it.
     */
    private function getOrCreateBookByRequest(Request $request): Book
    {
        $book = null;
        if ($request->get('_bookId'))
            $book = $this->bookRepository->find($request->get('_bookId'));
        if ($request->get('_bookEditionId') && !$book)
            if ($bookEdition = $this->bookEditionRepository->find($request->get('_bookEditionId')))
                $book = $bookEdition->getBook();
        return $book ?? new Book();
    }


    /**
     * @param Request $request
     * Returns a book object. If there is a bookEdition id specified in the request, and that bookEdition exists, it returns this bookEdition. Otherwise, it returns a new instance of it.
     */
    private function getOrCreateBookEditionByRequest(Request $request): BookEdition
    {
        $bookEdition = null;
        if ($request->get('_bookEditionId'))
            $bookEdition = $this->bookEditionRepository->find($request->get('_bookEditionId'));
        if (!$bookEdition && $request->get('_edition') && $request->get('_bookId'))
            $bookEdition = $this->bookEditionRepository->findByEditionAndBookId($request->get('_edition'), $request->get('_bookId'));
        return $bookEdition ?? new BookEdition();
    }

}