<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends BaseController
{
    private string $error = '';

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
     * @Route("/create-or-update/author", name="createOrUpdateAuthor")
     */
    public function createOrUpdateAuthor(Request $request): Response
    {
        if ($request->get('_create')) {
            if ($this->requiredFieldsFilled($request)) {
                $author = $this->_createOrUpdateAuthor($request);
                return $this->redirectToRoute('author', ['id' => $author->getId()]);
            }
        }
        return $this->render('library/authors/create-update-author.html.twig', [
            'error' => $this->error,
            'author' => $request->query->get('id') ?
                $this->authorRepository->find($request->query->get('id')) :
                '',
        ]);
    }

    /**
     * @Route("/delete/author/{id}", name="deleteAuthor")
     */
    public function deleteAuthor(string $id): Response
    {
        $author = $this->authorRepository->find($id);
        if ($author) {
            $entityManager = $this->getDoctrine()->getManager();
            try {
                $entityManager->remove($author);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->render('library/authors/author.html.twig', [
                    'author' => $author,
                    'toShowBooks' => $this->bookManagementService->getBookEditionLangsByBooks($author->getBooks()),
                    'error' => $e->getMessage()
                ]);
            }
            return $this->redirectToRoute('authorList');
        }
        return $this->renderErrorPage();
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

    /**
     * @param Request $request
     * @return Author
     * Creates an Author with the data received from the request
     */
    private function _createOrUpdateAuthor(Request $request): Author
    {
        $existentAuthor = $request->get('_authorId') ? $this->authorRepository->find($request->get('_authorId')) : null;
        $author = $existentAuthor ?? new Author();
        $entityManager = $this->getDoctrine()->getManager();
        $author->setName($request->get('_name'));
        $entityManager->persist($author);
        $entityManager->flush();
        return $author;
    }

    /**
     * @param Request $request
     * @return bool
     * Checks if every required field is filled
     */
    private function requiredFieldsFilled(Request $request): bool
    {
        $requiredFieldFilled = $request->get('_name');
        if (!$requiredFieldFilled)
            $this->error = 'There are some missing fields';
        return $requiredFieldFilled;
    }
}