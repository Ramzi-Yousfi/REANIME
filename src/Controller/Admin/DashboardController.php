<?php

namespace App\Controller\Admin;

use App\Entity\Anime;
use App\Entity\Carrier;
use App\Entity\Episode;
use App\Entity\Genre;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use App\Entity\VideoCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
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

        yield MenuItem::subMenu('Boutique', 'fa fa-article')->setSubItems([
         MenuItem::linkToCrud('category-produit', 'fas fa-th-large', ProductCategory::class),
         MenuItem::linkToCrud('livraison', 'fas fa-truck', Carrier::class),
         MenuItem::linkToCrud('produit', 'fas fa-tags', Product::class)
         ]);
        yield MenuItem::subMenu('Anime', 'fa fa-article')->setSubItems([
         MenuItem::linkToCrud('category-anime', 'fas fa-photo-video', VideoCategory::class),
         MenuItem::linkToCrud('genre', 'far fa-object-group', Genre::class),
         MenuItem::linkToCrud('episode', '	fas fa-tasks', Episode::class),
         MenuItem::linkToCrud('anime', '	fas fa-video', Anime::class),
        ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
     }
}
