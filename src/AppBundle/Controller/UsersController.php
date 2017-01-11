<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsersController extends Controller
{
    /**
     * @Route("/user/edit/{id}", name="edit_user")
     *
     * @param Request $req
     * @param int $id
     */
    public function editAction(Request $req, $id)
    {
        $authChecker = $this->get('security.authorization_checker');

        if (!$authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('login'));
        }

        // assure the authorized user is the user in the URL

        return $this->render('users/edit_user.html.twig');
    }
}
