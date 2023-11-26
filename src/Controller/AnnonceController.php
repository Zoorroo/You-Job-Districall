<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;


use Doctrine\Persistence\ManagerRegistry;
use App\Form\AnnonceType;
use App\Form\AttributType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/annonce')]
class AnnonceController extends AbstractController
   
{
    #[Route('/new', name:'annonce.new')]
    public function ajouterAnnonce(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger, UserInterface $user = null): Response
    {
        $iduser = ($user != null) ? $user->getId() : null;

        $entityManager = $doctrine->getManager();
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $description = $form['description']->getData();
            $annonce->setIduser($iduser);
            $entityManager->persist($data);
            $entityManager->flush();

            $repository = $doctrine->getRepository(annonce::class);
            $annonce = $repository->findBy(['description' => $description]);

            foreach ($annonce as $valeur) {
                $idannonce = $valeur->getId();
            }

            return $this->redirectToRoute('annonce.liste', ["idannonce" => $idannonce]);
        } else {
            return $this->render('annonce/new.html.twig', ['form' => $form->createView(), "iduser" => $iduser]);
        }
    }


   
    #[Route('/supprimer/{id}', name : 'annonce.supprimer')]
    public function supprimerAnnonce($id, ManagerRegistry $doctrine,UserInterface $user= NULL)
    {
        if($user!=NULL){
            $iduser=$user->getId();}
            else{
                $iduser=NULL;
            }
        $repository = $doctrine->getRepository(Annonce::class);
        $annonce = $repository->find($id);
        if($annonce->getIduser()==$iduser){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($annonce);
        $entityManager->flush();
        return $this->redirectToRoute('annonce.liste');}
        else{
            $message="Vous n'avez pas accès à cet fonctionnalité";
            return $this->render('acces.html.twig', ['message' => $message ]);}
    }

    #[Route('/', name : 'annonce.liste')]
    public function listeAnnonce(ManagerRegistry $doctrine, UserInterface $user= NULL): Response
    {
        if($user!=NULL){
            $iduser=$user->getId();
        $role=$user->getRoles();}
            else{
                $iduser=NULL;
                $role=NULL;
            }
        $repository = $doctrine->getRepository(Annonce::class);
        $annonces = $repository->findAll();
        return $this->render('annonce/index.html.twig', ['annonces' => $annonces,'iduser'=>$iduser,'role'=>$role]);
    }

    #[Route('/modifier/{id?0}', name:'annonce.modifier')]
    public function modifierAnnonce(Annonce $annonce = null, ManagerRegistry $doctrine, Request $request,SluggerInterface $slugger,UserInterface $user): Response
    {   if($user!=NULL){
        $iduser=$user->getId();
        $role=$user->getRoles();}
        else{
            $iduser=NULL;
            $role=NULL;
        }
        
        if ($iduser==$annonce->getIduser()){
        if(!$annonce){
            $annonce = new Annonce();
        }
        
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data= $form->getData();
            $entityManager->persist($data);
            $entityManager->flush();
            return $this->redirectToRoute('annonce.liste');
        }
            else{
                return $this->render('annonce/modifier.html.twig', ['form' => $form->createView(),'iduser'=>$iduser,'role'=>$role ]);
            }}
        else{
            $message="Vous ne pouvez pas modifier cette annonce";
            return $this->render('acces.html.twig', ['message' => $message ]);
        }
}
#[Route('/{id}', name : 'annonce.detail')]
public function afficherAnnonce(ManagerRegistry $doctrine,Request $request,$id,UserInterface $user=NULL): Response
{
    if($user!=NULL){
        $iduser=$user->getId();
        $role=$user->getRoles();}
        else{
            $iduser=NULL;
            $role=NULL;
        }
    $annonce_id = $doctrine->getRepository(Annonce::class)->find($id);
    ;

    

    if(!$annonce_id){
        // $this->addFlash('error', "Erreur cette annonce n'existe pas");
        return $this->redirectToRoute('annonce.liste');
    }
    return $this->render('annonce/detail.html.twig', ['annonce_id' => $annonce_id,'id'=>$id,'ident'=>$id,'iduser'=>$iduser,"role"=>$role]);
}




}
