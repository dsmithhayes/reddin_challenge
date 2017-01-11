<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/home/welcome", name="welcome")
     */
    public function welcomeAction(Request $request)
    {
        $authChecker = $this->get('security.authorization_checker');

        if (!$authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('login'));
        }

        // get the user from the current session, deprecated but works in 2.8
        $user = $this->get('security.context')->getToken()->getUser();

        return $this->render('home/welcome.html.twig', [
            'user' => $user
        ]);
    }
}
