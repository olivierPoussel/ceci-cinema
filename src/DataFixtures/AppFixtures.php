<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 20; $i++) { 
            $acteur = new Acteur();
            $acteur
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
            ;
            $manager->persist($acteur);
        }

        $manager->flush();
    }
}
