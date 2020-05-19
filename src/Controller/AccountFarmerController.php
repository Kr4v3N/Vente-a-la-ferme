<?php

namespace App\Controller;

use App\Entity\Farmer;
use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Form\AccountType;
use App\Form\FarmerType;
use App\Form\PasswordUpdateType;
use App\Repository\RoleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AccountFarmerController extends AbstractController
{
    /**
     * Permet d afficher et de gérer le formulaire de connexion
     *
     * @Route("/login", name="account_login")
     *
     * @param AuthenticationUtils $utils
     *
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }


    /**
     * Permet de se déconnecter
     *
     * @Route("/logout", name="account_logout")
     *
     * Retourne rien du tout
     * @return void
     */
    public function logout() {}


    /**
     * Permet d afficher le formulaire d inscription
     *
     * @Route("/register", name="account_register")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     * @throws \Exception
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, RoleRepository $roleRepository)
    {

        $farmer = new Farmer();

        $form = $this->createForm(FarmerType::class, $farmer);

        // gere la requete qui & été soumise
        $form->handleRequest($request);

        $errors = $form->getErrors();

        if ($form->isSubmitted() && $form->isValid()){

//            if($form['photoProfil']->getData() != null)
//            {
//                $photoProfil = $form['photoProfil']->getData();
//                $fileNameProfil = md5(uniqid()) . '.' . $photoProfil->guessExtension();
//                $photoProfil->move($this->getParameter('upload_directory'), $fileNameProfil);
//                $farmer->setPhotoProfil($fileNameProfil);
//            }
//            if($form['photoFarm']->getData() != null)
//            {
//                $photoFarm = $form['photoFarm']->getData();
//                $fileNameFarm = md5(uniqid()) . '.' . $photoFarm->guessExtension();
//                $photoFarm->move($this->getParameter('upload_directory'), $fileNameFarm);
//                $farmer->setPhotoFarm($fileNameFarm);
//            }

            $role = $roleRepository->findOneBy(['title' => 'ROLE_FARMER']);

            $farmer->getUser()->addUserRole($role);

            $password = $form->getData()->getUser()->getPassword();

            $hash = $encoder->encodePassword($farmer->getUser(), $password);

            $farmer->getUser()->setPassword($hash);

            $manager->persist($farmer);

            $this->addFlash(
                'success',
                "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter"
            );
            $manager->flush();

            return $this->redirectToRoute('account_login');

        }

        return $this->render('account/registration.html.twig', [
            'form' => $form->createView(),
            'errors' => $this->getErrorMessages($form),
        ]);

    }


    /**
     * Permet d afficher et de traiter le formulaire de modification de profil
     *
     * @Route("/account/profile", name="account_profile")
     *
     * @IsGranted("ROLE_FARMER")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function profile(Request $request, ObjectManager $manager)
    {
//      getUser permet de recuperer l utilisateur qui est connecté
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre compte a bien été modifier!"
            );

            return $this->redirectToRoute('account_profile');
        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet de modifier le mot de passe
     *
     * @Route("/account/password-update", name="account_password")
     *
     * @IsGranted("ROLE_FARMER")
     *
     * @param Request $request
     *
     * @param ObjectManager $manager
     *
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function updatePassword(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//          1. Vérifier que le oldPassword du formulaire soit le même que le password de l user
            if (!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){
//                Gérer l'erreur, Je veux l acces au champ oldPassword
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas le mot de passe actuel ! "));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();

                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié!"
                );

                return $this->redirectToRoute('home');
            }
        }
        return $this->render('account/password.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * Get real errors in symfony $form->getErrors()
     * @return array
     */
    public function getErrorMessages($form)
    {
        $errors = [];


            foreach ($form->getErrors() as $key => $error) {
                $errors[] = $error->getMessage();
            }

        if ($form->isSubmitted()) {
            foreach ($form->all() as $child) {
                if (!$child->isValid()) {
                    $errors[] = self::getErrorMessages($child)[0];
                }
            }
        }

        return $errors;
    }

}