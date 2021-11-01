<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\Enumerator\Language;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends BaseController
{

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @Route("/register", name="register")
     * Registration form for new users
     */
    public function register(Request $request): Response
    {
        $optionsArray = ['languages' => Language::getEnumList()];
        $routeResponse = $this->render('library/authentication/register.html.twig', $optionsArray);
        if ($request->get('_email')) {
            $user = new User();
            $user->setEmail($request->get('_email'));
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $request->get('_password')));
            $user->setLanguage($request->get('_language'));
            $user->setRoles(['ROLE_USER']);
            try {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $routeResponse = $this->redirectToRoute('home');
            } catch (\Exception $e) {
                array_push($optionsArray, ['error' => $e->getMessage()]);
                $routeResponse = $this->render('library/authentication/register.html.twig', $optionsArray);
            }
        }
        return $routeResponse;
    }
}
