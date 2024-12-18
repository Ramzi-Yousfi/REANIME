<?php

namespace App\Controller\Admin;

use App\Classe\DashboardCustom;
use App\Entity\Anime;
use App\Entity\Carrier;
use App\Entity\Comments;
use App\Entity\Episode;
use App\Entity\Genre;
use App\Entity\Home;
use App\Entity\News;
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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    private $entityManger;
    private $dashboardCustom;
    public function __construct(EntityManagerInterface $entityManger , DashboardCustom $dashboardCustom)
    {
        $this->entityManger = $entityManger;
        $this->dashboardCustom = $dashboardCustom;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $chart = $this->dashboardCustom->getChartbuilderLine();
        $pie = $this->dashboardCustom->getChartbuilderPie();
        $Bar = $this->dashboardCustom->getChartbuilderBar();
        $allUsers = $this->dashboardCustom->getAllUsers();
        return $this->render('dashboard/index.html.twig', [
            'chart'=>$chart,
            'camanber'=>$pie,
            'bar'=>$Bar,
            'allUsers'=>$allUsers,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="./image/logo.png">');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToUrl('stripe ','fas fa-money-check-alt','https://dashboard.stripe.com/test/dashboard');
        yield MenuItem::linkToUrl('Google Analytics ','	fas fa-chart-line','https://analytics.google.com/analytics/web/#/p271014670/reports/defaulthome');
        yield MenuItem::linkToUrl('mailjet ','far fa-paper-plane','https://app.mailjet.com/dashboard');
        yield MenuItem::linkToCrud('Page Accueil', 'fas fa-user-edit', Home::class);
        yield MenuItem::section('utilisateurs', 'fas fa-user-friends');
        yield MenuItem::linkToCrud('édit', 'fas fa-user-edit', User::class);
        ;


        /**
         *  pour avoir un accordion menu !! attention ca marche pas en asynchrone !!
         * yield MenuItem::subMenu('Boutique', 'fa fa-article')->setSubItems([ ici les sous menu   ])
         **/
        yield MenuItem::section('Boutique', 'fas fa-folder-open');
        yield MenuItem::linkToCrud('category-produit', 'fas fa-th-large', ProductCategory::class);
        yield MenuItem::linkToCrud('livraison', 'fas fa-truck', Carrier::class);
        yield MenuItem::linkToCrud('produit', 'fas fa-tags', Product::class);
        yield MenuItem::linkToCrud('commandes', 'fas fa-cart-plus', Order::class);
        yield MenuItem::linkToCrud('commentaires ', 'far fa-comments', Comments::class);


        yield MenuItem::section('Anime', 'fas fa-caret-square-right');
        yield MenuItem::linkToCrud('category-anime', 'fas fa-photo-video', VideoCategory::class);
        yield MenuItem::linkToCrud('genre', 'far fa-object-group', Genre::class);
        yield MenuItem::linkToCrud('episode', '	fas fa-tasks', Episode::class);
        yield MenuItem::linkToCrud('anime', '	fas fa-video', Anime::class);

        yield MenuItem::section('News', 'fas fa-broadcast-tower');
        yield MenuItem::linkToCrud('actualite', '	far fa-newspaper', News::class);

        yield MenuItem::section('', '');
        yield MenuItem::linkToRoute('voir le site ','	far fa-eye','home');

    }
    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
     }
}
