<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/home/welcome")
     */
    public function welcomeAction()
    {
        return $this->render('home/template.html.twig');
    }
}
