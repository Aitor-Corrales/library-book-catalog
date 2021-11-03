<?php

namespace App\Controller;

use App\Repository\EditorRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorController extends BaseController
{
    private EditorRepository $editorRepository;
    private BookManagementService $bookManagementService;

    public function __construct(EditorRepository $editorRepository, BookManagementService $bookManagementService)
    {
        $this->editorRepository = $editorRepository;
        $this->bookManagementService = $bookManagementService;
    }

    /**
     * @Route("/editors", name="editorList")
     */
    public function editorList(): Response
    {
        return $this->render('library/editors/editor-list.html.twig', [
            'editors' => $this->editorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/editor/{id}", name="editor")
     */
    public function editorPage(int $id): Response
    {
        $editor = $this->editorRepository->find($id);
        $bookEditionLangs = $this->bookManagementService->getBookEditionLangsByBookEditions($editor->getBookEditions());
        if ($editor) {
            return $this->render('library/editors/editor.html.twig', [
                'editor' => $editor,
                'toShowBooks' => $bookEditionLangs,
            ]);
        }
        return $this->renderErrorPage();
    }
}