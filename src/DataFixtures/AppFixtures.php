<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use App\Entity\Film;
use App\Entity\Realisateur;
use App\Entity\Role;
use App\Entity\Salle;
use App\Entity\Seance;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

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

        $role1 = new Role();
        $role1->setFilm($film)->setActeur($acteur)->setNom($faker->firstName);
        $manager->persist($role1);
        $role2 = new Role();
        $role2->setFilm($film)->setActeur($acteur)->setNom($faker->firstName);
        $manager->persist($role2);

        $seance1 = new Seance();
        $date = DateTime::createFromFormat('Y-m-d H:i:s','2021-01-15 18:00:00');
        $seance1->setDateSeance($date)->setFilm($film)->setSalle($salle); 
        $manager->persist($seance1);
        

        $user = new User();
        $user->setEmail('user@ex.com')->setPseudo('user')->setPassword($this->encoder->encodePassword($user, 'user'));
        $manager->persist($user);
        $user2 = new User();
        $user2->setEmail('admin@ex.com')->setPseudo('admin')->setPassword($this->encoder->encodePassword($user, 'admin'))->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $manager->flush();
    }
}
