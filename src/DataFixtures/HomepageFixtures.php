<?php

namespace App\DataFixtures;

use App\Entity\Homepage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class HomepageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        $homepage = new Homepage();
        $homepage->setBackgroundImage("/assets/images/4238.jpg");
        $homepage->setMainTitle("Bienvenue à la ferme");
        $homepage->setConsummerTitle("Vous êtes locavore");
        $homepage->setConsummerText("bsdh qzerjhzer qzejhzeihhf ZEHJZE jhgDGS HJGSDJHQSDHQ");
        $homepage->setConsummerImage("http://www.elixir.tn/wp-content/uploads/2015/01/fruit1.jpg");
        $homepage->setFarmerTitle("Vous êtes producteur");
        $homepage->setFarmerImage("https://p3.storage.canalblog.com/32/60/368878/44205573_m.jpg");
        $homepage->setFarmerText("df fzjbqerigqe gqergqhegfqd fqlisufhqizhfqizuef dsflhdfl");
        // $manager->persist($product);
        $manager->persist($homepage);
        $manager->flush();
    }
}
