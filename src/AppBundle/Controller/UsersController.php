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

        // deprecated, but works in 2.8
        $currentUser = $this->get('security.context')->getToken()->getUser();

        // assure its the current user
        if ($currentUser->getId() !== (int) $id) {
            return $this->redirect($this->generateUrl('welcome'));
        }

        // assure the authorized user is the user referenced by `$id`

        // get the user repository
        $userRepo = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $userRepo->find($id);

        if (!$user) {
            $error = 'This user does not exist.';
        }

        // check if the request was a POST, update the user info accordingly
        if ($req->isMethod('POST')) {
            if ($req->get('new_password')) {
                $newPass = $req->get('new_password');
                $secondPass = $req->get('second_password');

                if ($newPass === $secondPass) {
                    $encoder = $this->get('security.password_encoder');
                    $newPass = $encoder->encodePassword($user, $newPass);
                    $user->setPassword($newPass);
                } else {

                    // for some reason, this isn't being passed to the view
                    $error = 'Passwords do not match.';
                }
            }

            $user->setFirstName($req->get('first_name'))
                 ->setLastName($req->get('last_name'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($user);

            $entityManager->flush();
            $success = true;
        }

        return $this->render('users/edit_user.html.twig', [
            'user' => $user,
            'error' => $error ?? null,
            'success' => $success ?? null,
        ]);
    }
}
