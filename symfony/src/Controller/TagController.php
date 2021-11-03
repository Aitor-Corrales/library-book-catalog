<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends BaseController
{
    private string $error = '';

    private TagRepository $tagRepository;
    private BookManagementService $bookManagementService;

    public function __construct(TagRepository $tagRepository, BookManagementService $bookManagementService)
    {
        $this->tagRepository = $tagRepository;
        $this->bookManagementService = $bookManagementService;
    }

    /**
     * @Route("/tags", name="tagList")
     */
    public function tagList(): Response
    {
        return $this->render('library/tags/tag-list.html.twig', [
            'tags' => $this->tagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create-or-update/tag", name="createOrUpdateTag")
     */
    public function createOrUpdateTag(Request $request): Response
    {
        if ($request->get('_create')) {
            if ($this->requiredFieldsFilled($request)) {
                $tag = $this->_createOrUpdateTag($request);
                return $this->redirectToRoute('tag', ['id' => $tag->getId()]);
            }
        }
        return $this->render('library/tags/create-update-tag.html.twig', [
            'error' => $this->error,
            'tag' => $request->query->get('id') ?
                $this->tagRepository->find($request->query->get('id')) :
                '',
        ]);
    }

    /**
     * @Route("/delete/tag/{id}", name="deleteTag")
     */
    public function deleteTag(string $id): Response
    {
        $tag = $this->tagRepository->find($id);
        if ($tag) {
            $entityManager = $this->getDoctrine()->getManager();
            try {
                $entityManager->remove($tag);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->render('library/tags/tag.html.twig', [
                    'tag' => $tag,
                    'toShowBooks' => $this->bookManagementService->getBookEditionLangsByBooks($tag->getBooks()),
                    'error' => $e->getMessage()
                ]);
            }
            return $this->redirectToRoute('tagList');
        }
        return $this->renderErrorPage();
    }

    /**
     * @Route("/tag/{id}", name="tag")
     * @return Response
     */
    public function tag(int $id): Response
    {
        $tag = $this->tagRepository->find($id);
        if ($tag) {
            $bookEditionLangs = $this->bookManagementService->getBookEditionLangsByBooks($tag->getBooks());
            return $this->render('library/tags/tag.html.twig', [
                'tag' => $tag,
                'toShowBooks' => $bookEditionLangs,
            ]);
        }
        return $this->renderErrorPage();
    }


    /**
     * @param Request $request
     * @return Tag
     * Creates an Tag with the data received from the request
     */
    private function _createOrUpdateTag(Request $request): Tag
    {
        $existentTag = $request->get('_tagId') ? $this->tagRepository->find($request->get('_tagId')) : null;
        $tag = $existentTag ?? new Tag();
        $entityManager = $this->getDoctrine()->getManager();
        $tag->setName($request->get('_name'));
        $entityManager->persist($tag);
        $entityManager->flush();
        return $tag;
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