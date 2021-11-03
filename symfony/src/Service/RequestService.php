<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Tag;
use App\Repository\AuthorRepository;
use App\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Request;

class RequestService
{
    private AuthorRepository $authorRepository;
    private TagRepository $tagRepository;

    public function __construct(AuthorRepository $authorRepository, TagRepository $tagRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Request $request
     * @return Author[]
     * Returns an array of authors based on the authors stored in the request object
     */
    public function getAuthorsFromRequest(Request $request): array
    {
        $authors = [];
        if ($request->get('_authors') && count($request->get('_authors')))
            foreach ($request->get('_authors') as $authorId)
                $authors[] = $this->authorRepository->find($authorId);
        return $authors;
    }

    /**
     * @param Request $request
     * @return Tag[]
     * Returns an array of tags based on the tags stored in the request object
     */
    public function getTagsFromRequest(Request $request): array
    {
        $tags = [];
        if ($request->get('_tags') && count($request->get('_tags')))
            foreach ($request->get('_tags') as $tagId)
                $tags[] = $this->tagRepository->find($tagId);
        return $tags;
    }
}