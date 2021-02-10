<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\Word;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bienvenue dans le back-office !');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Acueil', 'fa fa-home'),
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

            MenuItem::section('― Groupes', 'fas fa-arrow-alt-circle-down'),
            MenuItem::linkToCrud('Gestion des groupes', 'fas fa-globe-americas', Group::class),
//            MenuItem::linkToCrud('Dictionnaire', 'fas fa-globe-americas', Word::class),


            MenuItem::section('― Apprenant·e·s', 'fas fa-arrow-alt-circle-down'),
            MenuItem::linkToCrud('Gestion des apprenant·e·s', 'fas fa-globe-americas', Student::class),

            MenuItem::section('― Enseignant·e·s', 'fas fa-arrow-alt-circle-down'),
            MenuItem::linkToCrud('Gestion des enseignant·e·s', 'fas fa-globe-americas', Teacher::class),

        ];
    }
}
