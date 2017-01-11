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
    public function editAction(Request $req, $id = null)
    {
        /*
        $authChecker = $this->get('security.authorization_checker');

        if (!$authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('login'));
        }
        */

        // assure the authorized user is the user referenced by `$id`

        // check if the request was a POST
            // update the database

        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $userRepo->find($id);

        if (!$user) {
            $error = 'This user does not exist.';
        }

        return $this->render('users/edit_user.html.twig', [
            'user' => $user,
            'error' => $error,
        ]);
    }
}
