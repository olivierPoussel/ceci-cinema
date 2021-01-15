<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use App\Entity\Film;
use App\Entity\Realisateur;
use App\Entity\Salle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->seed(0);

        for ($i=0; $i < 20; $i++) { 
            $acteur = new Acteur();
            $acteur
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
            ;
            $manager->persist($acteur);
        }
        $manager->flush();

        for ($j=0; $j < 10; $j++) { 
            $real = new Realisateur();
            $real
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName);
            $manager->persist($real);
        }
        $manager->flush();

        for ($k=0; $k < 10; $k++) { 
            $salle = new Salle();
            $salle->setNom("salle n° ".($k+1));
            $manager->persist($salle);
            
        }
        $manager->flush();

        $film = new Film();
        $film->setDuree(120)->setRealisateur($real)->setTitre('testFilm');
        $manager->persist($film);
        $manager->flush();
    }
}
