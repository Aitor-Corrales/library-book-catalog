<?php

namespace App\Controller;

use App\Service\SearchService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends BaseController
{
    private SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @Route("/search", name="search")
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->render('library/search.html.twig', [
            'toShowBooks' => $this->searchService->getBookEditionLangsByCriteria($request->get('searchTerm'))
        ]);
    }
}