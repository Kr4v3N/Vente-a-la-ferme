<?php

namespace App\Controller;

use App\Entity\Farmer;
use App\Entity\Product;
use App\Entity\ProductFarmer;
use App\Form\ProductFarmerType;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods="GET")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', ['products' => $productRepository->findAll()]);
    }

    /**
     *
     * @Route("/new", name="product_new", methods="GET|POST")
     *
     * @IsGranted("ROLE_FARMER")
     *
     */
    public function new(Request $request, ProductFarmer $productFarmer, Farmer $farmer): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $productFarmer->setFarmer($farmer->getId());
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods="GET")
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods="GET|POST")
     *
     * @IsGranted("ROLE_FARMER")
     */
    public function edit(Request $request, ProductFarmer $productFarmer): Response
    {
        $oldImage = $productFarmer->getImage();
        $form = $this->createForm(ProductFarmerType::class, $productFarmer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // upload image et modifier le nom
            if($form['image']->getData() != null) {

                $file = $productFarmer->getImage();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $productFarmer->setImage($fileName);
            } else {
                $productFarmer->setImage($oldImage);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('farmer_products', ['id' => $productFarmer->getId()]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $productFarmer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="product_delete")
     */
    public function deleteProduct(Request $request, ProductFarmer $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(ProductFarmer::class)->find($id);

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('farmer_products');
    }

    /**
     * @Route("/name/{name}", name="product_filter", methods="GET")
     */
    public function filter(ProductRepository $productRepository, $name)
    {
        $criteria= ['name' =>$name];
        $products = $productRepository->findBy($criteria);
        return $this->render('product/index.html.twig',
            ['products' => $products]
        );
    }
}
