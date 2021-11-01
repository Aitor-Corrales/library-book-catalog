<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends BaseController
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @Route("/tag/{id}", name="tag")
     * @return Response
     */
    public function tag(int $id): Response
    {
        $tag = $this->tagRepository->find($id);
        if ($tag) {
            return $this->render('library/tag.html.twig', [
                'tag' => $tag,
                'toShowBooks' => $tag->getBooks(),
            ]);
        }
        return $this->renderErrorPage();
    }
}