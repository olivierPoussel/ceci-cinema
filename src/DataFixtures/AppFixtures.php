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
        $acteurs = [];
        for ($i=0; $i < 20; $i++) { 
            $acteur = new Acteur();
            $acteur
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
            ;
            $manager->persist($acteur);
            $acteurs[] = $acteur;
        }
        $manager->flush();

        $realistateurs = [];
        for ($j=0; $j < 10; $j++) { 
            $real = new Realisateur();
            $real
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName);
            $manager->persist($real);
            $realistateurs[] = $real;
        }
        $manager->flush();

        $salles = [];
        for ($k=0; $k < 10; $k++) { 
            $salle = new Salle();
            $salle->setNom("salle n° ".($k+1));
            $manager->persist($salle);
            $salles[] = $salle;
        }
        $manager->flush();

        $films = [];
        for ($k=0; $k < 10; $k++) { 
            $film = new Film();
            $film
                ->setDuree(rand(90,240))
                ->setRealisateur($realistateurs[rand(0,count($realistateurs)-1)])
                ->setTitre($faker->words(rand(2,10), true));
            $manager->persist($film);
            $films[] = $film;
            
            $nbRole = rand(2,5);
            for ($l=0; $l < $nbRole; $l++) { 
                
                $role = new Role();
                $role
                    ->setFilm($film)
                    ->setActeur($acteurs[rand(0,count($acteurs)-1)])
                    ->setNom($faker->firstName);
                $manager->persist($role);
            }
            $manager->flush();
        }

        $date = new DateTime();
        foreach ($films as $key => $film) {
            for ($i=0; $i < 50 ; $i++) { 
                $seance1 = new Seance();
                // $date = DateTime::createFromFormat('Y-m-d H:i:s','2021-01-15 18:00:00');
                $dateSeance = (clone $date)->modify('+'.(6 * $i).' hours');
                $seance1
                    ->setDateSeance($dateSeance)
                    ->setFilm($film)
                    ->setSalle($salles[$key]); 
                $manager->persist($seance1);
            }
            $manager->flush();
        }

        $user = new User();
        $user->setEmail('user@ex.com')->setPseudo('user')->setPassword($this->encoder->encodePassword($user, 'user'));
        $manager->persist($user);
        $user2 = new User();
        $user2->setEmail('admin@ex.com')->setPseudo('admin')->setPassword($this->encoder->encodePassword($user, 'admin'))->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);

        $manager->flush();
    }
}
