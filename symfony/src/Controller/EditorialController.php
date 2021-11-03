<?php

namespace App\Controller;

use App\Entity\Editorial;
use App\Repository\EditorialRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorialController extends BaseController
{
    private EditorialRepository $editorialRepository;
    private BookManagementService $bookManagementService;
    private string $error = '';

    public function __construct(EditorialRepository $editorialRepository, BookManagementService $bookManagementService)
    {
        $this->editorialRepository = $editorialRepository;
        $this->bookManagementService = $bookManagementService;
    }

    /**
     * @Route("/editorials", name="editorialList")
     */
    public function editorialList(): Response
    {
        return $this->render('library/editorials/editorial-list.html.twig', [
            'editorials' => $this->editorialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create-or-update/editorial", name="createOrUpdateEditorial")
     */
    public function createOrUpdateEditorial(Request $request): Response
    {
        if ($request->get('_create')) {
            if ($this->requiredFieldsFilled($request)) {
                $editorial = $this->_createOrUpdateEditorial($request);
                return $this->redirectToRoute('editorial', ['id' => $editorial->getId()]);
            }
        }
        return $this->render('library/editorials/create-update-editorial.html.twig', [
            'error' => $this->error,
            'editorial' => $request->query->get('id') ?
                $this->editorialRepository->find($request->query->get('id')) :
                '',
        ]);
    }

    /**
     * @Route("/delete/editorial/{id}", name="deleteEditorial")
     */
    public function deleteEditorial(string $id): Response
    {
        $editorial = $this->editorialRepository->find($id);
        if ($editorial) {
            $entityManager = $this->getDoctrine()->getManager();
            try {
                $entityManager->remove($editorial);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->render('library/editorials/editorial.html.twig', [
                    'editorial' => $editorial,
                    'toShowBooks' => $this->bookManagementService->getBookEditionLangsByBookEditions($editorial->getBookEditions()),
                    'error' => $e->getMessage()
                ]);
            }
            return $this->redirectToRoute('editorialList');
        }
        return $this->renderErrorPage();
    }

    /**
     * @Route("/editorial/{id}", name="editorial")
     */
    public function editorialPage(int $id): Response
    {
        $editorial = $this->editorialRepository->find($id);
        if ($editorial) {
            $bookEditionLangs = $this->bookManagementService->getBookEditionLangsByBookEditions($editorial->getBookEditions());
            return $this->render('library/editorials/editorial.html.twig', [
                'editorial' => $editorial,
                'toShowBooks' => $bookEditionLangs,
                'error' => $this->error,
            ]);
        }
        return $this->renderErrorPage();
    }

    /**
     * @param Request $request
     * @return Editorial
     * Creates an Editorial with the data received from the request
     */
    private function _createOrUpdateEditorial(Request $request): Editorial
    {
        $existentEditorial = $request->get('_editorialId') ? $this->editorialRepository->find($request->get('_editorialId')) : null;
        $editorial = $existentEditorial ?? new Editorial();
        $entityManager = $this->getDoctrine()->getManager();
        $editorial->setName($request->get('_name'));
        $entityManager->persist($editorial);
        $entityManager->flush();
        return $editorial;
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