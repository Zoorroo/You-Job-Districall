<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Message; 

class MessagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
          // Insertion de faux utilisateurs
          for ($i=0; $i<10; $i++){
            $id_utilisateur = 1 . $i;
            $id_annonce = 2 . $i;
            $id_conversation = 3 . $i;
            $date = 4;
            

            $utilisateur = new Message();
            $utilisateur->setIdUtilisateur($id_utilisateur);
            $utilisateur->setIdAnnonce($id_annonce);

            

            $manager->persist($utilisateur);
        }

        $manager->flush();
    }
}

