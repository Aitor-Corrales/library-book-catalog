<?php

namespace App\Controller;

use App\Entity\Translator;
use App\Repository\TranslatorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TranslatorController extends BaseController
{
    private string $error = '';

    private TranslatorRepository $translatorRepository;

    public function __construct(TranslatorRepository $translatorRepository)
    {
        $this->translatorRepository = $translatorRepository;
    }

    /**
     * @Route("/translators", name="translatorList")
     */
    public function translatorList(): Response
    {
        return $this->render('library/translators/translator-list.html.twig', [
            'translators' => $this->translatorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create-or-update/translator", name="createOrUpdateTranslator")
     */
    public function createOrUpdateTranslator(Request $request): Response
    {
        if ($request->get('_create')) {
            if ($this->requiredFieldsFilled($request)) {
                $translator = $this->_createOrUpdateTranslator($request);
                return $this->redirectToRoute('translator', ['id' => $translator->getId()]);
            }
        }
        return $this->render('library/translators/create-update-translator.html.twig', [
            'error' => $this->error,
            'translator' => $request->query->get('id') ?
                $this->translatorRepository->find($request->query->get('id')) :
                '',
        ]);
    }

    /**
     * @Route("/delete/translator/{id}", name="deleteTranslator")
     */
    public function deleteTranslator(string $id): Response
    {
        $translator = $this->translatorRepository->find($id);
        if ($translator) {
            $entityManager = $this->getDoctrine()->getManager();
            try {
                $entityManager->remove($translator);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->render('library/translators/translator.html.twig', [
                    'translator' => $translator,
                    'toShowBooks' => $translator->getBookEditionLangs(),
                    'error' => $e->getMessage()
                ]);
            }
            return $this->redirectToRoute('translatorList');
        }
        return $this->renderErrorPage();
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
                'toShowBooks' => $translator->getBookEditionLangs(),
            ]);
        }
        return $this->renderErrorPage();
    }

    /**
     * @param Request $request
     * @return Translator
     * Creates an Translator with the data received from the request
     */
    private function _createOrUpdateTranslator(Request $request): Translator
    {
        $existentTranslator = $request->get('_translatorId') ? $this->translatorRepository->find($request->get('_translatorId')) : null;
        $translator = $existentTranslator ?? new Translator();
        $entityManager = $this->getDoctrine()->getManager();
        $translator->setName($request->get('_name'));
        $translator->setEmail($request->get('_email'));
        $entityManager->persist($translator);
        $entityManager->flush();
        return $translator;
    }

    /**
     * @param Request $request
     * @return bool
     * Checks if every required field is filled
     */
    private function requiredFieldsFilled(Request $request): bool
    {
        $requiredFieldFilled = $request->get('_name') &&
            $request->get('_email');
        if (!$requiredFieldFilled)
            $this->error = 'There are some missing fields';
        return $requiredFieldFilled;
    }
}