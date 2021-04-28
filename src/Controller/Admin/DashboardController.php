<?php

namespace App\Controller\Admin;

use App\Classe\DashboardCostom;
use App\Entity\Anime;
use App\Entity\Carrier;
use App\Entity\Episode;
use App\Entity\Genre;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use App\Entity\VideoCategory;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\MenuItemTrait;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use http\Exception\BadHeaderException;
use mysql_xdevapi\BaseResult;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    private $entityManger;
    private $dashboardCostom;
    public function __construct(EntityManagerInterface $entityManger ,DashboardCostom $dashboardCostom)
    {
        $this->entityManger = $entityManger;
        $this->dashboardCostom = $dashboardCostom;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $chart = $this->dashboardCostom->getChartbuilderLine();
        $pie = $this->dashboardCostom->getChartbuilderPie();

        return $this->render('dashboard/index.html.twig', [
         'chart'=>$chart,
            'camanber'=>$pie
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('REANIME');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('utilisateurs', 'fas fa-user-friends');
        yield MenuItem::linkToCrud('édit', 'fas fa-user-edit', User::class);
        yield MenuItem::linkToCrud('photo de profil', 'fas fa-user-cog', User::class);

        /**
         *  pour avoir un accordion menu !! attention ca marche pas en asynchrone !!
         * yield MenuItem::subMenu('Boutique', 'fa fa-article')->setSubItems([ ici les sous menu   ])
         **/
        yield MenuItem::section('Boutique', 'fas fa-folder-open');
        yield MenuItem::linkToCrud('category-produit', 'fas fa-th-large', ProductCategory::class);
        yield MenuItem::linkToCrud('livraison', 'fas fa-truck', Carrier::class);
        yield MenuItem::linkToCrud('produit', 'fas fa-tags', Product::class);
        yield MenuItem::linkToCrud('commandes', 'fas fa-cart-plus', Order::class);


        yield MenuItem::section('Anime', 'fas fa-caret-square-right');
        yield MenuItem::linkToCrud('category-anime', 'fas fa-photo-video', VideoCategory::class);
        yield MenuItem::linkToCrud('genre', 'far fa-object-group', Genre::class);
        yield MenuItem::linkToCrud('episode', '	fas fa-tasks', Episode::class);
        yield MenuItem::linkToCrud('anime', '	fas fa-video', Anime::class);

        yield MenuItem::section('', '');
        yield MenuItem::linkToRoute('voir le site ','	fas fa-home','home');

    }
    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
     }
}
