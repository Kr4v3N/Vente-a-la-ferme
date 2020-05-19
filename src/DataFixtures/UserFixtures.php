<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $farmerRole = new Role();
        $farmerRole->setTitle('ROLE_FARMER');
        $manager->persist($farmerRole);

        $consumerRole = new Role();
        $consumerRole->setTitle('ROLE_CONSUMER');
        $manager->persist($consumerRole);


        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'password');
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($hash);
            $user->addUserRole($farmerRole);
            $user->setCreateAt($faker->dateTimeBetween('-8 months'));
            $manager->persist($user);
            $this->addReference('userFarmer' . $i, $user);
        }

        for ($i = 0; $i < 20; $i++)
        {
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'password');
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($hash);
            $user->addUserRole($consumerRole);
            $user->setCreateAt($faker->dateTimeBetween('-8 months'));
            $manager->persist($user);
            $this->addReference('userConsumer' . $i, $user);
        }

        // set one admin
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'admin');
            $user->setFirstName('admin');
            $user->setLastName('admin');
            $user->setEmail('admin@gmail.com');
            $user->setPassword($hash);
            $user->addUserRole($adminRole);
            $user->setCreateAt($faker->dateTimeBetween('-8 months'));
            $manager->persist($user);
            $this->addReference('userAdmin', $user);

        $manager->flush();
    }
}
