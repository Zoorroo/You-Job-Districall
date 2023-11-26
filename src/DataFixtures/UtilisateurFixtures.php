<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;
// use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;

// Pour lancer l'insertion de personne les commandes :
// symfony console doctrine:fixtures:load
// Puis
// symfony console doctrine:fixtures:load --append

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Test d'insertion d'utilisateur avec des Fake data mais pb avec le create

        // $faker = Factory::create('fr_FR');

        // for ($i=0; $i<10; $i++){
        //     $utilisateur = new Utilisateur();
        //     $utilisateur->setNom($faker->name);
        //     $utilisateur->setPrenom($faker->firstName);
        //     $utilisateur->setEmail($faker->firstName, "@gmail.com");
        //     $utilisateur->setRole("fake");

        //     $manager->persist($utilisateur);
        // }

        // Insertion de faux utilisateurs
        for ($i=0; $i<10; $i++){
            $nom = "Nom" . $i;
            $prenom = "Prenom" . $i;
            $email = "Email" . $i . "@gmail.com";
            

            $utilisateur = new Utilisateur();
            $utilisateur->setNom($nom);
            $utilisateur->setPrenom($prenom);
            $utilisateur->setEmail($email);
            $utilisateur->setRole("fake");
            $utilisateur->setPassword($password);
            $manager->persist($utilisateur);
        }

        $manager->flush();
    }
}
