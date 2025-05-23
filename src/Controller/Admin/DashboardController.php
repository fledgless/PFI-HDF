<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Page;
use App\Entity\Article;
use App\Entity\Category;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="public\images\logo.png" decoding="async" width="75">Pole Insertion Formation');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Retour au site', 'fa fa-arrow-left', 'app_home');
        yield MenuItem::linkToLogout('Se déconnecter', 'fa fa-sign-out');

        if ($this->isGranted('ROLE_SUPERADMIN')) {
            yield MenuItem::section('Gestion des utilisateurs');
            yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class)
                ->setPermission('ROLE_ADMIN');
            yield MenuItem::linkToCrud('Nouvel utilisateur', 'fa fa-user-plus', User::class)
                ->setAction('new')
                ->setPermission('ROLE_ADMIN');
        }

        if ($this->isGranted('ROLE_ADMIN')) {
             yield MenuItem::section('Gestion des pages');
            yield MenuItem::linkToCrud('Pages', 'fa fa-file', Page::class);
            yield MenuItem::linkToCrud('Nouvelle page', 'fa fa-plus', Page::class)
                ->setAction('new');

            yield MenuItem::section('Gestion des catégories');
            yield MenuItem::linkToCrud('Catégories', 'fa fa-folder', Category::class);
            yield MenuItem::linkToCrud('Nouvelle catégorie', 'fa fa-folder-plus', Category::class)
                ->setAction('new');
        }

        if ($this->isGranted('ROLE_AUTEUR')) {
            yield MenuItem::section('Gestion des articles');
            yield MenuItem::linkToCrud('Articles', 'fa fa-newspaper', Article::class);
            yield MenuItem::linkToCrud('Nouvel article', 'fa fa-plus', Article::class)
                ->setAction('new');
        }
    }
}
