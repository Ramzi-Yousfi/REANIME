<?php

namespace App\Controller;

use App\Entity\Home;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager =$entityManager;
    }


    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $slider = $this->entityManager->getRepository(Product::class)->findByIsNew(10);
        $home = $this->entityManager->getRepository(Home::class)->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'slider'=>$slider,
            'home'=>$home
        ]);
    }
}
