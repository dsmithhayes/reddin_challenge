<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    /**
     * @Route("/users/login", name="users_login")
     */
    public function loginAction(Request $request)
    {
        // Handle the login form
        if ($request->isMethod('POST')) {
            
        }

        // Display the login form
        return $this->render('users/login.html.twig');
    }
}
