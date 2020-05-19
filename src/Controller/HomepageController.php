<?php

namespace App\Controller;

use App\Entity\Homepage;
use App\Form\HomepageType;
use App\Repository\FarmerRepository;
use App\Repository\HomepageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/homepage")
 */
class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage_index", methods="GET")
     */
    public function index(HomepageRepository $homepageRepository): Response
    {
        return $this->render('homepage/index.html.twig', [
            'homepages' => $homepageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="homepage_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $homepage = new Homepage();
        $form = $this->createForm(HomepageType::class, $homepage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($homepage);
            $em->flush();

            return $this->redirectToRoute('homepage_index');
        }

        return $this->render('homepage/new.html.twig', [
            'homepage' => $homepage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="homepage_show", methods="GET")
     */
    public function show(Homepage $homepage): Response
    {

        return $this->render('homepage/show.html.twig', ['homepage' => $homepage, 'farmer' =>$farmers]);
    }


    /**
     * @Route("/{id}", name="homepage_delete", methods="DELETE")
     */
    public function delete(Request $request, Homepage $homepage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$homepage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($homepage);
            $em->flush();
        }

        return $this->redirectToRoute('homepage_index');
    }
}
