<?php

namespace App\Controller;

use App\Entity\Consumer;
use App\Entity\Farmer;
use App\Repository\ConsumerRepository;
use App\Repository\FarmerConsumerRepository;
use App\Repository\ProductFarmerRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FarmerRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function showDashboard(FarmerRepository $farmerRepository,
                                  ConsumerRepository $consumerRepository,
                                  ProductRepository $productRepository
    )
    {

        $farmers = $farmerRepository->countFarmers();
        $lastFarmers = $farmerRepository->countLastFarmers();

        $consumers = $consumerRepository->countConsumers();
        $lastConsumers = $consumerRepository->countLastConsumers();
        $consumers = $consumerRepository->countConsumers();
        $products = $productRepository->countProducts();
             $favorites = $farmerRepository->countFavorites();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'countFarmers' => $farmers[0]['COUNT(id)'],
            'countConsumers' => $consumers[0]['COUNT(id)'],
            'countProducts' => $products[0]['COUNT(id)'],
            'countLastFarmers' => $lastFarmers[0]['COUNT(user.first_name)'],
            'countLastConsumers' => $lastConsumers[0]['COUNT(user.first_name)'],
          'countFavorites' => $favorites[0]['COUNT(farmer_id)']
        ]);
    }

//    /**
//     * @Route("/admin/login", name="admin_login")
//     */
//    public function login()
//    {
//        //TODO
//        return $this->render('admin/login.html.twig');
//    }

}
