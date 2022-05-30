<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
Use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i=0;$i<100;$i++)
        {
            $property = new Property();
            $property
                ->setTitle($faker->company())
                ->setDescription($faker->sentence(3))
                ->setSurface($faker->numberBetween(20, 350))
                ->setRooms($faker->numberBetween(2, 10))
                ->setBedrooms($faker->numberBetween(1, 9))
                ->setFloor($faker->numberBetween(0, 15))
                ->setPrice($faker->numberBetween(100000, 1000000))
                ->setHeat($faker->numberBetween(0, 50))
                ->setCity($faker->city())
                ->setAddress($faker->streetAddress())
                ->setPostalCode($faker->secondaryAddress())
                ->setSold(false);
                $manager->persist($property);
        }

        $manager->flush();
    }
}
