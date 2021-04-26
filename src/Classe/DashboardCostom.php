<?php


namespace App\Classe;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardCostom
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

    public function getChartbuilderPie()
    {
        $Pie = $this->chartbuilder->createChart(Chart::TYPE_PIE);
        $Pie->setData([
            'labels' => [1, 2, 3],
            'datasets' => [
                [

                    'backgroundColor' => ['#FF0000', '#FFFF00', '#FF0000'],


                    'data' => [50, 40, 10],
                ],
            ],
        ]);
        return $Pie;
    }
}