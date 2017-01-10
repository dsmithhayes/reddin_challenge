<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/home/welcome", name="welcome")
     */
    public function welcomeAction(Request $request)
    {
        return $this->render('home/template.html.twig');
    }
}
