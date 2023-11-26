<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateur;
use App\Entity\Connexion;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Security\Core\User\UserInterface;
/** 

* @param Request $request
*/
#[Route('utilisateur')]
class UtilisateurController extends AbstractController
{

    #[Route('/ajouter_utilisateur')]

    // Insert un utilisateur directement dans la base de donnée
public function ajouterUtilisateur(Request $request,UtilisateurRepository $utilisateurRepository, EntityManagerInterface $entityManager): Response
{ 
   
    $utilisateur = new Utilisateur();
    
    
    
    $form = $this->createForm(UtilisateurType::class, $utilisateur);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        $data= $form->getData();
        $entityManager->persist($data);
        $entityManager->flush();
        return $this->redirectToRoute('utilisateur.liste');
        }
      
        else{
            return $this->render('utilisateur/ajouter.html.twig', ['form' => $form->createView() ]);
        }
    }
    
   
    #[Route('/', name: 'utilisateur.liste')]
    
   
      public function listeUtilisateur(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Utilisateur::class);
        $utilisateurs = $repository->findAll();
        return $this->render('utilisateur/index.html.twig', ['utilisateurs' => $utilisateurs]);
    }


     /**
     * @Route("/modifier_utilisateur/{id}", name="modifier_utilisateur")
     * Method({"GET", "POST"})
     */
    #[Route('/modifier/{id}',name:'utilisateur.modifier')]


    public function modifierUtilisateur(Utilisateur $utilisateur, Request $request, EntityManagerInterface $entityManager, UserInterface $user): Response {
        
        $iduser=$user->getId();
        if(!$utilisateur){
        $utilisateur = new Utilisateur();
        }
        if($iduser==$utilisateur->getId()){
        $form = $this->createForm(RegistrationFormType::class, $utilisateur);
        $form->handleRequest($request);
        $form->remove('plainPassword');
        $form->remove('roles');
        $password=$utilisateur->getPassword();
        $roles=$utilisateur->getRoles();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setPassword($password);
            $utilisateur->setRoles($roles);
            $data= $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            
            return $this->redirectToRoute('utilisateur.liste');
        }
        return $this->render('utilisateur/modifier.html.twig', [
            'form' => $form->createView()
        ]);}
        else{
            $message="Vous n'avez pas accès à cet fonctionnalité";
            return $this->render('acces.html.twig', ['message' => $message ]);}
    }
/**
     * @Route("/supprimer_utilisateur/{id}" , name="supprimer_utilisateur")
     */
    public function supprimer_utilisateur( $id, ManagerRegistry $doctrine,EntityManagerInterface $entityManager) {
        $repository = $doctrine->getRepository(Utilisateur::class);
        $utilisateur = $repository->find($id);
        $entityManager->remove($utilisateur);
        $entityManager->flush();
        return $this->redirectToRoute('utilisateur.liste');

      }



    #[Route('/{id}', name : 'utilisateur.detail')]
    public function afficherUtilisateur(ManagerRegistry $doctrine,UserInterface $user): Response
    {
        $iduser=$user->getId();
        $repository = $doctrine->getRepository(Utilisateur::class);
        $utilisateur_id = $repository->find($iduser);
        if(!$utilisateur_id){
        
            return $this->redirectToRoute('utilisateur.liste');
        }
        return $this->render('utilisateur/detail.html.twig', ['utilisateur_id' => $utilisateur_id]);
    }

    

   

}


// Info pour  créer un formulaire, pour cela on peut en créer un facilement avec la commande php bin/console make:form, suivre les étapes :)
?>