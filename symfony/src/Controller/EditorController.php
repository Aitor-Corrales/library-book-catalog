<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Repository\EditorialRepository;
use App\Repository\EditorRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorController extends BaseController
{
    private string $error = '';

    private EditorRepository $editorRepository;
    private EditorialRepository $editorialRepository;
    private BookManagementService $bookManagementService;

    public function __construct(EditorRepository $editorRepository, EditorialRepository $editorialRepository, BookManagementService $bookManagementService)
    {
        $this->editorRepository = $editorRepository;
        $this->editorialRepository = $editorialRepository;
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
     * @Route("/create-or-update/editor", name="createOrUpdateEditor")
     */
    public function createOrUpdateEditor(Request $request): Response
    {
        if ($request->get('_create')) {
            if ($this->requiredFieldsFilled($request)) {
                $editor = $this->_createOrUpdateEditor($request);
                return $this->redirectToRoute('editor', ['id' => $editor->getId()]);
            }
        }
        return $this->render('library/editors/create-update-editor.html.twig', [
            'error' => $this->error,
            'editorials' => $this->editorialRepository->findAll(),
            'editor' => $request->query->get('id') ?
                $this->editorRepository->find($request->query->get('id')) :
                '',
        ]);
    }

    /**
     * @Route("/delete/editor/{id}", name="deleteEditor")
     */
    public function deleteEditor(string $id): Response
    {
        $editor = $this->editorRepository->find($id);
        if ($editor) {
            $entityManager = $this->getDoctrine()->getManager();
            try {
                $entityManager->remove($editor);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->render('library/editors/editor.html.twig', [
                    'editor' => $editor,
                    'toShowBooks' => $this->bookManagementService->getBookEditionLangsByBookEditions($editor->getBookEditions()),
                    'error' => $e->getMessage()
                ]);
            }
            return $this->redirectToRoute('editorList');
        }
        return $this->renderErrorPage();
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

    /**
     * @param Request $request
     * @return Editor
     * Creates an Editor with the data received from the request
     */
    private function _createOrUpdateEditor(Request $request): Editor
    {
        $existentEditor = $request->get('_editorId') ? $this->editorRepository->find($request->get('_editorId')) : null;
        $editor = $existentEditor ?? new Editor();
        $entityManager = $this->getDoctrine()->getManager();
        $editor->setName($request->get('_name'));
        $editor->setEmail($request->get('_email'));
        $editor->setEditorial($this->editorialRepository->find($request->get('_editorial')));
        $entityManager->persist($editor);
        $entityManager->flush();
        return $editor;
    }

    /**
     * @param Request $request
     * @return bool
     * Checks if every required field is filled
     */
    private function requiredFieldsFilled(Request $request): bool
    {
        $requiredFieldFilled = $request->get('_name') &&
            $request->get('_email') &&
            $request->get('_editorial');
        if (!$requiredFieldFilled)
            $this->error = 'There are some missing fields';
        return $requiredFieldFilled;
    }
}