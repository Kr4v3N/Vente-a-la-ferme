<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Farmer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Class ConsumerFixtures
 *
 * @package \App\DataFixtures
 */
class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 100; $i++){

            if(mt_rand(0, 1)) {
                $comment = new Comment();
                $comment->setContent($faker->paragraph())
                    ->setRating(mt_rand(1, 5))
                    ->setAuthor($this->getReference('userConsumer' . rand(0, 19)))
                    ->setFarmer($this->getReference('farmer' . rand(0, 19)));

                $manager->persist($comment);

            }
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            FarmerFixtures::class,
        );
    }
}
