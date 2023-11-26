<?php

namespace App\Controller;


use App\Entity\Annonce;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType, ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType,CheckboxType};

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UserInterface $user = NULL,ManagerRegistry $doctrine): Response
    {
        if($user!=NULL){
        $iduser=$user->getId();
        $role=$user->getRoles();}
        else{
            $iduser=NULL;
            $role=NULL;
        }
        
        $repositoryann = $doctrine->getRepository(Annonce::class);
        
        $annonce = $repositoryann->findAll();
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('search.handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]])
          
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        return $this->render('index.html.twig', [
            'iduser' => $iduser,'role'=>$role,'form' => $form->createView(),'annonces'=>$annonce
        ]);
        

    }
    
   

}
?>