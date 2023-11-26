<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\SendMailService;
use App\Form\ResetPasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController1Controller extends AbstractController
{
    #[Route('/connexion', name:'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        
  // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'sign_in_label' => 'Se connecter'
        ]);
    }

    #[Route('/deconnexion', name:'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    
}
?>