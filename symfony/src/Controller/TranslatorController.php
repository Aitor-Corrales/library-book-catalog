<?php

namespace App\Controller;

use App\Repository\TranslatorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TranslatorController extends BaseController
{
    private TranslatorRepository $translatorRepository;

    public function __construct(TranslatorRepository $translatorRepository)
    {
        $this->translatorRepository = $translatorRepository;
    }

    /**
     * @Route("/translators", name="translatorList")
     */
    public function editorialList(): Response
    {
        return $this->render('library/translator-list.html.twig', [
            'translators' => $this->translatorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/translator/{id}", name="translator")
     */
    public function translatorPage(int $id): Response
    {
        $translator = $this->translatorRepository->find($id);
        if ($translator) {
            return $this->render('library/translators/translator.html.twig', [
                'translator' => $translator,
            ]);
        }
        return $this->renderErrorPage();
    }
}