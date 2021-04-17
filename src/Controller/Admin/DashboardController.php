<?php

namespace App\Controller\Admin;

use App\Entity\Anime;
use App\Entity\Episode;
use App\Entity\Genre;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use App\Entity\VideoCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            ->setTitle('REANIME');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('category-produit', 'fas fa-th-large', ProductCategory::class);
        yield MenuItem::linkToCrud('produit', 'fas fa-tags', Product::class);
        yield MenuItem::linkToCrud('category-anime', 'fas fa-photo-video', VideoCategory::class);
        yield MenuItem::linkToCrud('genre', 'far fa-object-group', Genre::class);
        yield MenuItem::linkToCrud('episode', '	fas fa-tasks', Episode::class);
        yield MenuItem::linkToCrud('anime', '	fas fa-video', Anime::class);
    }
}
