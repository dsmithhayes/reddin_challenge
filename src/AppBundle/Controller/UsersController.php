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

        // get the user repository
        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $userRepo->find($id);

        if (!$user) {
            $error = 'This user does not exist.';
        }

        // check if the request was a POST, update the user info accordingly
        if ($req->isMethod('POST')) {
            $user->setFirstName($req->get('first_name'))
                 ->setLastName($req->get('last_name'))
                 ->setEmail($req->get('email'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($user);

            if ($entityManager->flush()) {
                $success = true;
            }
        }

        return $this->render('users/edit_user.html.twig', [
            'user' => $user,
            'error' => $error ?? null,
            'success' => $success ?? null,
        ]);
    }
}
