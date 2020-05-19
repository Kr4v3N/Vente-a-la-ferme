<?php

namespace App\DataFixtures;

use App\Entity\Consumer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Class ConsumerFixtures
 *
 * @package \App\DataFixtures
 */
class ConsumerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $consumer = new Consumer();
            $consumer->setUserName($faker->userName());
            $consumer->setAddress($faker->address());
            $consumer->setCity($faker->city());
            $consumer->setPostalCode($faker->numberBetween(12536, 80586));
            $consumer->setUser($this->getReference('userConsumer' . $i));

            $manager->persist($consumer);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
