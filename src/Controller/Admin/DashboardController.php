<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\Word;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
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
        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(GroupCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bienvenue dans le back-office !');
    }

    public function configureMenuItems(): iterable
    {
        return [
//            MenuItem::linktoDashboard('Accueil', 'fa fa-home'),
            MenuItem::linkToCrud('Groupes', 'fas fa-users', Group::class),
            MenuItem::linkToCrud('Dictionnaires', 'fas fa-book', Word::class),
            MenuItem::linkToCrud('Apprenant·e·s', 'fas fa-user-graduate', Student::class),
            MenuItem::linkToCrud('Enseignant·e·s', 'fas fa-chalkboard-teacher', Teacher::class),

        ];
    }
}
