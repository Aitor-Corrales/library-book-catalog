<?php

namespace App\Controller\Authentication;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends BaseController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('library/authentication/login.html.twig', ['error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
}