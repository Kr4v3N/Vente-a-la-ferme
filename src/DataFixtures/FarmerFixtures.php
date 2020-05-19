<?php


namespace App\DataFixtures;

use App\Entity\Farmer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class FarmerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $genres = ['male', 'female'];

        for ($i = 0; $i < 20; $i++)
        {
            $user = new Farmer();
            //element au hasard de ce tableau
            $genre = $faker->randomElement($genres);
            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg';

            // si genre est = a  male alors écrit 'men/' :SINON: écrit 'women/'
            $picture .= ($genre == 'male' ? 'men/' : 'women/') . $pictureId;

            $user->setFarmName("Nom de la ferme n°$i");
            $user->setAddress($faker->address());
            $user->setCity($faker->city());
            $user->setLat($faker->latitude($min = 42, $max = 51));
            $user->setLng($faker->longitude($min = 4, $max = 2));
            $user->setPostalCode($faker->numberBetween(12536, 80586));
            $user->setFarmDescription($faker->text(400));
            $user->setUser($this->getReference('userFarmer' . $i));
            $user->setPhone($faker->phoneNumber());
            $user->setPhotoFarm($faker->imageUrl());
            $user->setPhotoProfil($picture);
            $manager->persist($user);
            $this->addReference('farmer' . $i, $user);

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