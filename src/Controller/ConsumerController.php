<?php
namespace App\Controller;
use App\Entity\Comment;
use App\Entity\Consumer;
use App\Entity\Contact;
use App\Entity\Product;
use App\Entity\Farmer;
use App\Entity\FarmerConsumer;
use App\Form\CommentType;
use App\Form\ConsumerProfilType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\ConsumerRepository;
use App\Repository\FarmerRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductFarmerRepository;
use App\Repository\ProductRepository;
use App\Services\uploadManager;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ConsumerController extends Controller
{
    /**
     * @Route("/consumer/index", name="consumer")
     */
    public function index(FarmerRepository $farmerRepository, Request $request,
                          ProductCategoryRepository $productCategoryRepository,
                            ProductRepository $productRepository,
                            UserInterface $user, ConsumerRepository $consumerRepository)
    {

        // all farms
        $farmers = $farmerRepository->findBy([],['id' => 'asc']);

        //dd($farmers);
        //affiche la ferme du farmer connecté, avec les fermes qui ont le meme code postal.
        $user = $this->getUser();
        if (isset($user)) {
            $userRole = $this->getUser()->getRoles()['0'];
            $userId = $this->getUser()->getId();
            if ($userRole === 'ROLE_FARMER') {
                $farmer = $farmerRepository->findOneBy(['user' => $userId ]);
                $farmerPostalCode = $farmer->getPostalCode();
                $firstPostalCode = substr($farmerPostalCode, 0, 2);
                $farmers = $farmerRepository->farmWithSamePostalCode($firstPostalCode);
                $key = array_search($farmer,$farmers);
                unset($farmers[$key]);
                array_unshift($farmers, $farmer);
                //dd($farmers);
            }
        }
        $searchBar = $request->request->get('searchBar') ?? null;
        $categoryId = $request->request->get('category') ?? null;
        if ($searchBar != null | $categoryId != null){
            $farmers = $farmerRepository->farmMultisearch($searchBar, $categoryId);
        }
        if(empty($farmers)) {
            $this->addFlash('notFarm', 'Aucune ferme ne correspond à votre recherche');
        }

        // récupère toutes les catégories
        $categories = $productCategoryRepository->findAll();

        //pagination
        $farmers  = $this->get('knp_paginator')->paginate($farmers, $request->query->getInt('page', 1 ), 6);

        $consumerId = $this->getUser();
        if ($consumerId !== null){
            $consumerId = $this->getUser()->getId();
        }
        $consumer = $consumerRepository->findOneBy(['user'=> $consumerId]);

        return $this->render('consumer/index.html.twig', [
            'farmers' => $farmers,
            'categories' => $categories,
            'consumer' => $consumer,
        ]);
    }

    /**
     * @Route("/consumer/farm/{id}-{slug}", name="farm_show", requirements={"slug": "[a-z0-9\-]*"})
     *
     */
    public function showFarmer(Request $request, ContactNotification $notification, $slug, $id,
                               FarmerRepository $repository,
                               ProductRepository $productRepository,
                               ObjectManager $objectManager,
                               ProductFarmerRepository $productFarmerRepository,
                               ConsumerRepository $consumerRepository,
                               \Swift_Mailer $mailer,
                               EntityManagerInterface $em)
    {

        $farmer = $repository->find($id);
        // count view number for a farm

//        dump($request->getClientIp());
        $count = $farmer->getCountView();
        $count ++;
        $farmer->setCountView($count);
        $em->flush();

        $product = $productRepository->findAll();

        $productsFarmer = $productFarmerRepository->findBy(['farmer' => $id]);
        if ($farmer == null){
            return $this->redirectToRoute('consumer');
        }
        if ($farmer->getSlug() !== $slug)
        {
            return $this->redirectToRoute('farm_show',
                [
                    'id' => $farmer->getId(),
                    'slug' => $farmer->getSlug()
                ], 301);
        }

        //send an email to the farmer
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $message = (new \Swift_Message('Prise de contact'))

                ->setFrom('noreply@ventealaferme.com')
                ->setTo($farmer->getUser()->getEmail())
                ->setBody($this->render('email/contact.html.twig', [
                    'contact' => $contact
                ]), 'text/html');
            $result = $mailer->send($message);
            $this->addFlash('success', 'Votre courriel a bien été envoyé,
                je vous répondrai dans les plus brefs délais.');
        }

        // add a comment
        $comment = new Comment();
        $form1 =$this->createForm(CommentType::class, $comment);
        $form1->handleRequest($request);
        if($form1->isSubmitted() && $form1->isValid())
        {
            $comment->setFarmer($farmer) // le commentaires doit être relié à une ferme
            ->setAuthor($this->getUser()); //$this->getUser nous renvoie à l'utilisateur qui est actuellement connecté

            $objectManager->persist($comment);
            $objectManager->flush();

            $this->addFlash('success',
                "Votre commentaire a bien été pris en compte"
            );
        }

        $followedFarmers = $this->myFollowers($consumerRepository);

        $consumerId = $this->getUser();

        if ($consumerId !== null){
            $consumerId = $this->getUser()->getId();

        }
        $consumer = $consumerRepository->findOneBy(['user'=> $consumerId]);


        return $this->render('consumer/farm.html.twig',
            [
                'consumer' => $consumer,
                'followedFarmers' => $followedFarmers,
                'form' => $form->createView(),
                'farmers' => $farmer,
                'products' => $product,
                'productsFarmer' => $productsFarmer,
                'form1' => $form1->createView(),
            ]);
    }
    /**
     * @Route("/consumer/profil", name="consumer_profil")
     * @IsGranted("ROLE_CONSUMER", statusCode=404, message="Vous ne pouvez pas accéder à cette page !")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profilUser(ConsumerRepository $consumerRepository)
    {

        $userId = $this->getUser()->getId();
        $consumer = $consumerRepository->findOneBy(['user' => $userId]);

        return $this->render('consumer/profil.html.twig',
            [
                'consumer' => $consumer,
            ]);
      }


    /**
     * @Route("/consumer/profil/form", name="consumer_profil_form")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ConsumerRepository $consumerRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profilUserForm(uploadManager $uploadManager, Request $request, EntityManagerInterface $em,
                                   ConsumerRepository $consumerRepository)
    {
        $userId = $this->getUser()->getId();
        $consumer = $consumerRepository->findOneBy(['user' => $userId]);

        $oldProfilPicture = $consumer->getProfilPicture();

        $form = $this->createForm(ConsumerProfilType::class, $consumer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //upload image
            if ($form->get('profilPicture')->getData() != null) {
                $file = $form->get('profilPicture')->getData();
                //use uploadManager service
                $fileUploaded = $uploadManager->uploadFile($file);
                $consumer->setProfilPicture($fileUploaded);
            } else {
                $consumer->setProfilPicture($oldProfilPicture);
            }

            $em->flush();

            return $this->redirectToRoute('consumer_profil');

        }

        return $this->render('consumer/profilForm.html.twig', [
                'formConsumerProfil' => $form->createView(),
                'consumer' => $consumer,
            ]);
    }

    /**
     * @Route("/follow/{id}", name="follow")
     * @param Farmer $farmer
     * @param ConsumerRepository $consumerRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function follow(Farmer $farmer, ConsumerRepository $consumerRepository)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $consumer = $consumerRepository->findOneBy(['user'=> $user]);

        if (null === $consumer) {
            throw new NotFoundHttpException("Veuillez vous connecter");
        }
        if (null === $farmer) {
            throw new NotFoundHttpException("$farmer n'existe pas.");
        }

        $consumer->follow($farmer);

        $em->flush();

        return $this->redirectToRoute('farm_show', [
            'id' => $farmer->getId(),
            'slug' => $farmer->getSlug()
        ]);

    }


    /**
     * @param ConsumerRepository $consumerRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function myFollowers(ConsumerRepository $consumerRepository)
    {
        $followedFarmers = [];
        $user = $this->getUser();

        if (isset($user)) {
            if ($user->getRoles()['0'] === 'ROLE_CONSUMER') {
                $consumer = $consumerRepository->findOneBy(['user'=> $user]);
                $followedFarmers = $consumer->getFarmers();
            }
        }
        return $this->render('sideBar.html.twig',
            [
                'followedFarmers' => $followedFarmers,
            ]);
    }

}
