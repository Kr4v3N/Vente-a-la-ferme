<?php

namespace App\Controller;

use App\Form\PasswordUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordController extends AbstractController
{
    /**
     * @Route("/password/update", name="password_update")
     */
    public function passwordUpdate(Request $request, UserInterface $user,
                                        UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $form = $this->createForm(PasswordUpdateType::class, $user);

        $oldPassword = $request->request->get('password_update')['oldPassword'];
        $newPassword = $request->request->get('password_update')['newPassword'];
        $confirmPassword = $request->request->get('password_update')['confirmPassword'];

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($encoder->isPasswordValid($user, $oldPassword)) {

                if ($newPassword === $confirmPassword) {

                    $hash = $encoder->encodePassword($user, $newPassword);
                    $user->setPassword($hash);
                    $em->persist($user);
                    $em->flush();

                    $this->addFlash('success', 'Votre mot de passe a bien été changé !');

                    if ($user->getRoles()['0'] === "ROLE_FARMER") {
                        return $this->redirectToRoute('farmer_show');
                    } elseif ($user->getRoles()['0'] === "ROLE_CONSUMER") {
                        return $this->redirectToRoute('consumer_profil');
                    }

                } else {
                    $form->addError(new FormError("Vous n'avez pas confirmé votre mot de passe correctement" ));
                }

            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }

        }

        return $this->render('account/password.html.twig', [
           'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
