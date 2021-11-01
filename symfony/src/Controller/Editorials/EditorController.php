<?php

namespace App\Controller\Editorials;

use App\Controller\BaseController;
use App\Repository\EditorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorController extends BaseController
{
    private EditorRepository $editorRepository;

    public function __construct(EditorRepository $editorRepository)
    {
        $this->editorRepository = $editorRepository;
    }

    /**
     * @Route("/editors", name="editorList")
     */
    public function editorList(): Response
    {
        return $this->render('library/editor-list.html.twig', [
            'editors' => $this->editorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/editor/{id}", name="editor")
     */
    public function editorPage(int $id): Response
    {
        $editor = $this->editorRepository->find($id);
        if ($editor) {
            return $this->render('library/editors/editor.html.twig', [
                'editor' => $editor,
            ]);
        }
        return $this->renderErrorPage();
    }
}