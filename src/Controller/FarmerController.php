<?php

namespace App\Controller;

use App\Entity\Farmer;
use App\Entity\Product;
use App\Entity\User;
use App\Form\FarmerProfilType;
use App\Form\ProductFarmerType;
use App\Entity\ProductFarmer;
use App\Repository\FarmerRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\uploadManager;



/**
 * @Route("/farmer")
 *
 * @IsGranted("ROLE_FARMER", statusCode=404, message="Vous ne pouvez pas accéder à cette page !")
 *
 */
class FarmerController extends AbstractController
{
    /**
     * @Route("/", name="farmer_show", methods="GET")
     */
    public function dashboardFarmer(UserInterface $user, FarmerRepository $repository): Response
    {
        $user = $this->getUser();
        $farmer = $repository->findOneBy(['user'=> $user->getId()]);


        $countFarmerProduct = count($farmer->getProductFarmers());
        return $this->render('farmer/index.html.twig',
            ['farmer' => $farmer,
                'countFarmerProduct' => $countFarmerProduct]);
    }

    /**
     * Edit farmer profil
     * @Route("/edit/profil/{id}", name="edit_profil")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProfil(uploadManager $uploadManager, Request $request, UserInterface $user, FarmerRepository $farmerRepository, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em) : Response
    {
        $farmer = $farmerRepository->findOneBy(['user'=>$user->getId()]);
        //save info of old version of photos to keep them when form is submitted
        $OldPhotoProfil = $farmer->getPhotoProfil();
        $OldPhotoFarm = $farmer->getPhotoFarm();
        $OldPassword = $user->getPassword();
        $form = $this->createForm(FarmerProfilType::class, $farmer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // upload image et unique id for image
            if($form['photoProfil']->getData() != null)
            {
                $photoProfil = $form['photoProfil']->getData();
                $fileUploaded = $uploadManager->uploadFile($photoProfil);
                $farmer->setPhotoProfil($fileUploaded);
            }else{
                $farmer->setPhotoProfil($OldPhotoProfil);
            }
            if($form['photoFarm']->getData() != null)
            {
                $photoFarm = $form['photoFarm']->getData();
                $fileUploaded = $uploadManager->uploadFile($photoFarm);
                $farmer->setPhotoFarm($fileUploaded);
            }else{
                $farmer->setPhotoFarm($OldPhotoFarm);
            }

            $em->flush();
            return $this->redirectToRoute('profil', ['id' => $farmer->getId()]);
        }
        return $this->render('farmer/editProfil.html.twig',
            ['farmer'=>$farmer,
                'form' => $form->createView()
            ]);
    }

    /**
     * Show farmer profil
     * @Route("/profil", name="profil")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showProfil(UserInterface $user, FarmerRepository $farmerRepository): Response
    {
        $farmer = $farmerRepository->findOneBy(['user'=>$user->getId()]);

        return $this->render('farmer/profil.html.twig', [
            'farmer'=>$farmer,
        ]);
    }

    /**
     * @Route("/delete", name="delete_farmer")
     */
    public function deleteFarmer(UserInterface $user, FarmerRepository $farmerRepository, EntityManagerInterface $em) : Response
    {
        $farmer = $farmerRepository->findOneBy(['user'=>$user->getId()]);
        $user = $farmer->getUser();

        $currentUserId = $this->getUser()->getId();
        if ($currentUserId == $user->getId())
        {
            $session = $this->get('session');
            $session = new Session();
            $session->invalidate();
        }

        $em->remove($user);
        $em->remove($farmer);
        $em->flush();
        return $this->redirectToRoute('home');
    }


    /**
     * Show all product form one fuckin' farmer, you know !!!
     * @Route("/products", name="farmer_products")
     *
     * @param Farmer $farmer
     *
     * @return Response
     */
    public function allProductsFarmer(UserInterface $user, FarmerRepository $farmerRepository,
                                      Request $request, ProductCategoryRepository $productCategoryRepository)
    {
        $farmer = $farmerRepository->findOneBy(['user'=>$user->getId()]);
        $productsFarmer = $this->getDoctrine()
            ->getRepository(ProductFarmer::class)
            ->findBy(['farmer' => $farmer]);

        return $this->render('farmer/allProduct.html.twig', [
            'productsFarmer' => $productsFarmer,
            'productCategory' => $productCategoryRepository->findAll(),
                ]);
    }

    /**
     * Add product for a farmer
     * @Route("/farmer/product/new", name="new_product")
     *
     * That farmer roles can add products!
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     */
    public function addProduct(uploadManager $uploadManager,
                               Request $request,
                               FarmerRepository $farmerRepository,
                               UserInterface $user)
    {
        $farmer = $farmerRepository->findOneBy(['user'=>$user->getId()]);

        $productFarmer = new ProductFarmer();
        $form = $this->createForm(ProductFarmerType::class, $productFarmer);
        $farmer = $farmerRepository->findOneBy(['user'=>$user->getId()]);
        $productFarmer->setFarmer($farmer);
        $form->handleRequest($request);
        $oldProductImage = $productFarmer->getImage();

        if ($form->isSubmitted() && $form->isValid()){

            // upload image et modifier le nom
            if($form['image']->getData() != null) {
                $productFarmer->setFarmer($farmer);
                $file = $productFarmer->getImage();
                //use service uploadManager
                $fileUploaded = $uploadManager->uploadFile($file);
                $productFarmer->setImage($fileUploaded);
            } else {
                $productFarmer->setImage($oldProductImage);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($productFarmer);

            $em->flush();

            return $this->redirectToRoute('farmer_products');
        }

        return $this->render('farmer/addProduct.html.twig', array(
            'form' => $form->createView(),
            'productFarmer' => $productFarmer,
            'farmer' => $farmer,
        ));
    }

//    TODO non fonctionelle a voir avec celine et faire les verif secur
    /**
     * Add product for a farmer
     *
     * @Route("/farmer/product/edit/{id}", name="edit_product")
     *
     */
    public function editProduct(Request $request, ProductFarmer $productFarmer, ProductRepository $productRepository,
                                EntityManagerInterface $em, ProductCategoryRepository $productCategoryRepository,
                                uploadManager $uploadManager)
    {

        $productId = $productFarmer->getProduct()->getId();
        $product = $productRepository->findOneBy(['id' => $productId]);


        $name = $request->request->get('name');
        $category = $request->request->get('category');
        $description = $request->request->get('description');
        //$image = $request->request->get('image');
        $price = $request->request->get('price');
        $weight = $request->request->get('weight');
        $kiloPrice = $request->request->get('kiloPrice');

        $category = $productCategoryRepository->findOneBy(['name' => $category]);

        $uploadDir = 'uploads/';
        $filename = $_FILES['image']['name'];
        if (!empty($filename)) {

            $extension = pathinfo($filename, PATHINFO_EXTENSION); // on récupère l'extension, exemple "pdf"
            $filename = md5(uniqid()) . '.' . $extension; // concatène nom de fichier unique avec l'extension
            // on génère un nom de fichier à partir du nom de fichier sur le poste du client (mais vous pouvez générer ce nom autrement si vous le souhaitez)
            $uploadFile = $uploadDir . basename($filename);
            // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ca y est, le fichier est uploadé
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

            $productFarmer->setImage($filename);
        }
        $productFarmer->setPrice($price);
        $productFarmer->setWeight($weight);
        $productFarmer->setKiloPrice($kiloPrice);
        $product->setName($name);
        $product->setDescription($description);
        $product->setCategory($category);

        $em->flush();

        return $this->redirectToRoute('farmer_products');

    }

    /**
     * @Route("/farmer/recipe", name="recipe")
     */
    public function showRecipe()
    {
        return $this->render('farmer/showRecipe.html.twig');
    }


    /**
     * send email by one farmer to all users who added his farm as favorite
     * @Route("/email", name="email")
     */
    public function sendNewsletter(Request $request, \Swift_Mailer $mailer, UserInterface $user, FarmerRepository $farmerRepository)
    {
        $to = [];
        // récupérer le farmer id depuis le user id
        $farmer = $farmerRepository->findOneBy(['user'=>$user->getId()]);
        //aller chercher tous les consumers qui ont mon farmer id dans farmer_consumer
        $consumers = $farmer->getConsumer();
        // récupérer tous les emails dans un tableau
        foreach ($consumers as $consumer)
        {
            array_push($to, $consumer->getUser()->getEmail());
        }
        // créer un formulaire d'envoi avec 1 champ pour remplir le sujet et un pour le contenu


        $form = $this->createFormBuilder()
            ->add('subject', TextType::class,
                [    'label'  => 'Sujet',
                    'attr' => [
                        'class' => 'text-box',
                        'placeholder' => 'Sujet de votre newsletter'
                    ]]
            )
            ->add('message', TextareaType::class,
                [    'label'  => 'Contenu',
                    'attr' => [
                        'class' => 'text-box',
                        'placeholder' => 'Contenu de votre newletter'
                    ]]
            )
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "subject" and "message" keys
            $message = (new \Swift_Message(($form->getData()['subject'])))
                ->setFrom($user->getEmail())
                ->setTo($to)
                ->setBody(($form->getData()['message']));
            $result = $mailer->send($message);
            $this->addFlash('Success', 'Bravo vous avez envoyé votre newsletter');
            return $this->redirectToRoute('farmer_show');
        }

        return $this->render('farmer/sendNewsletter.html.twig',
            ['form' => $form->createView(),
            ]
        );
    }
}
