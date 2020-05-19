<?php

namespace App\Controller;

use App\Entity\Homepage;
use App\Form\HomepageType;
use App\Repository\ConsumerRepository;
use App\Repository\FarmerRepository;
use App\Repository\UserRepository;
use App\Services\uploadManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserRepository $userRepository, FarmerRepository $farmerRepository, ConsumerRepository $consumerRepository)
    {
//        $user = $this->getUser();
//
//        if (isset($user)) {
//            $user = $this->getUser()->getId();
//            $role = $this->getUser()->getRoles()[0];
//
//            if ($role === "ROLE_FARMER"){
//
//                $farmer = $farmerRepository->findOneBy(['user' => $user]);
//                return $this->redirectToRoute('farmer_show');
//
//            }
//            elseif ($role === "ROLE_CONSUMER") {
//
//                $consumer = $consumerRepository->findOneBy(['user' => $user]);
//                return $this->redirectToRoute('consumer');
//            }
//        }

        $home = $this->getDoctrine()
                    ->getRepository(Homepage::class)
                    ->findAll();

        $farmers = $farmerRepository->findBy([],['id' => 'desc'], 4);

        return $this->render('home/home.html.twig', ['home' => $home, 'farmers' => $farmers]);
    }

    /**
     * @Route("/homepage/{id}/edit", name="homepage_edit", methods="GET|POST")
     */
    public function edit(uploadManager $uploadManager, Request $request, Homepage $homepage)
    {
        $form = $this->createForm(HomepageType::class, $homepage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload background image
            $backgroundImage = $form->get('backgroundImage')->getData();
            //use uploadManager service
            $fileUploaded = $uploadManager->uploadFile($backgroundImage);
            $homepage->setBackgroundImage($backgroundImage);

            //upload consumer image
            $consummerImage = $form->get('consummerImage')->getData();
            //use uploadManager service
            $fileUploaded = $uploadManager->uploadFile($consummerImage);
            $homepage->setconsummerImage($fileUploaded);

            //upload consumer image
            $farmerImage = $form->get('farmerImage')->getData();
            //use uploadManager service
            $fileUploaded = $uploadManager->uploadFile($farmerImage);
            $homepage->setFarmerImage($fileUploaded);

            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('homepage_index', ['id' => $homepage->getId()]);
            return $this->redirectToRoute('home');
        }

        return $this->render('homepage/edit.html.twig', [
            'homepage' => $homepage,
            'form' => $form->createView(),
        ]);
    }
}
