<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ChoiceType, ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType,CheckboxType};

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search.index')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    #[Route('/search', name:'search.recherche')]
    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('search.handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]])
            // ->add('Categorie',ChoiceType::class,[
            //     'choices'  => [
            //         'Informatique' => 'informatique',
            //         'Agriculture' => 'agriculture',
            //         'Patisserie' => 'patisserie',
            //         ],
            //     'expanded'  => true,
            //     'multiple'  => true,
            // ])  
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        return $this->render('base.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/search/handleSearch', name:'search.handleSearch')]
    public function handleSearch(Request $request, EntrepriseRepository $repo, AnnonceRepository $repo_annonce,UserInterface $user = NULL)
    {
        if($user!=NULL){
            $iduser=$user->getId();
            $role=$user->getRoles();}
            else{
                $iduser=NULL;
                $role=NULL;
            }
        // $query = $request->request->get('form')['query'];
        $query = $request->request->all('form')['query'];
        if($query) {
            $entreprises = $repo->entrepriseRecherche($query);

            $annonces = $repo_annonce->annoncesRecherche($query);
        }
        return $this->render('search/index.html.twig', [
            'entreprises' => $entreprises,'annonces'=>$annonces,'iduser'=>$iduser,'role'=>$role
        ]);
    }
}
