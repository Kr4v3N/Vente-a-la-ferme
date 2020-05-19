<?php

namespace App\Controller;

use App\Entity\Consumer;
use App\Form\ConsumerType;
use App\Repository\RoleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountConsumerController extends AbstractController
{
    /**
     * Permet d afficher le formulaire d inscription du consumer
     *
     * @Route("/consumer/register", name="account_consumer_register")
     *
     * @throws \Exception
     */
    public function register(Request $request, ObjectManager $manager,
                             UserPasswordEncoderInterface $encoder, RoleRepository $roleRepository)
    {

        $consumer = new Consumer();

        $form = $this->createForm(ConsumerType::class, $consumer);

        // gere la requete qui & été soumise
        $form->handleRequest($request);

        $errors = $form->getErrors();

        if ($form->isSubmitted() && $form->isValid()){


            $role = $roleRepository->findOneBy(['title' => 'ROLE_CONSUMER']);

            $consumer->getUser()->addUserRole($role);

            $password = $form->getData()->getUser()->getPassword();

            $hash = $encoder->encodePassword($consumer->getUser(), $password);

            $consumer->getUser()->setPassword($hash);

            $manager->persist($consumer);

            $this->addFlash(
                'success',
                "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter"
            );
            $manager->flush();

            return $this->redirectToRoute('account_login');

        }

        return $this->render('account_consumer/registration.html.twig', [
            'form' => $form->createView(),
            'errors' => $this->getErrorMessages($form),

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
