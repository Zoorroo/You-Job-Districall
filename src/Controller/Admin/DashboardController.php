<?php

namespace App\Controller\Admin;
use App\Entity\Annonce;
use App\Entity\Attribut;
use App\Entity\Entreprise;
use App\Entity\Utilisateur;
use App\Entity\Message;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(AnnonceCrudController::class)->generateUrl();

        return $this->redirect($url);

       
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Youjob');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Attribut', 'fas fa-list', Attribut::class);
        yield MenuItem::linkToCrud('Annonce', 'fas fa-briefcase', Annonce::class);
        yield MenuItem::linkToCrud('Entreprise', 'fas fa-building', Entreprise::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Message', 'fas fa-commenting', Message::class);
    
    }
    
}
