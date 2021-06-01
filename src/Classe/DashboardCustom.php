<?php


namespace App\Classe;


use App\Entity\Anime;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\VideoCategory;
use App\Repository\AnimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardCustom extends AbstractController
{
    private $chartbuilder;
    private $entityManager;

    public function __construct(ChartBuilderInterface $chartBuilder, EntityManagerInterface $entityManager)
    {
        $this->chartbuilder = $chartBuilder;
        $this->entityManager = $entityManager;
    }

    public function getChartbuilderLine()
    {
        $userInt = [];
        for ($i = 1; $i <= 12; $i++) {
            $userInt[] = count($this->entityManager->getRepository(User::class)->findByMonth($i));
        }

        $chart = $this->chartbuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'novembre', 'décembre'],
            'datasets' => [
                [
                    'label' => 'utilisateurs',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $userInt,
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);
        return $chart;
    }
    public function getAllUsers(){
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $allUsers = count($users);
        return $allUsers;
    }

    public function getChartbuilderPie()
    {
        $serie = $this->entityManager->getRepository(VideoCategory::class)->findByCat('serie');
        foreach ($serie as $s){
         $series = count($s->getAnimes());
        }
        $film = $this->entityManager->getRepository(VideoCategory::class)->findByCat('film');
        foreach ($film as $f){
         $films = count($f->getAnimes());
        }

        $Pie = $this->chartbuilder->createChart(Chart::TYPE_PIE);
        $Pie->setData([
            'labels' => ['Films','Series' ],
            'datasets' => [
                [

                    'backgroundColor' => ['#dec82d' ,'#255782' ],


                    'data' => [$films, $series],
                ],
            ],
        ]);
        return $Pie;
    }
    public function getChartbuilderBar()
    {
        $stock = [];
        $name = [];
        $stocks = $this->entityManager->getRepository(Product::class)->findAllByStock(12);
        foreach ($stocks as $s){
            $stock[] = $s->getStock();
            $name[] = $s->getName();
        }
        $Bar = $this->chartbuilder->createChart(Chart::TYPE_BAR);
        $Bar->setData([
            'labels' => $name,
            'datasets' => [
                [
                    'label' => 'le stock le plus bas ',
                    'backgroundColor' => ['#FF0000', '#896a6a', '#a31d4d','#00bb00','#255782','#dec82d','#a02dde','#1da393'
                    ,'#1b1c1c','#345234','#adcd10','#cd7210'],
                    'data' => $stock,
                ],
            ],
        ]);
        return $Bar;
    }
}