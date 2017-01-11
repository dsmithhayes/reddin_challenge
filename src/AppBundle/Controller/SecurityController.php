<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * This class handles authenticating the user
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $req)
    {
        $authUtils = $this->get('security.authentication_utils');

        if ($error = $authUtils->getLastAuthenticationError()) {
            $error = $error->getMessage();
        }

        return $this->render('login.html.twig', [
            'error' => $error,
            'last_username' => $authUtils->getLastUsername()
        ]);
    }
}
