<?php

namespace App\Controller;

use App\Repository\TagRepository;
use App\Service\BookManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends BaseController
{
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

}