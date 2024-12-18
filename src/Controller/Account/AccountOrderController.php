<?php

namespace App\Controller\Account;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountOrderController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        return $this->entityManager = $entityManager;
    }

    #[Route('compte/mes-commande/', name: 'account_order')]
    public function index(): Response
    {
        $orders = $this->entityManager->getRepository(Order::class)->findSuccssOrder($this->getUser());
        return $this->render('account/order.html.twig',[
            'orders'=>$orders
        ]);
    }
    #[Route('compte/mes-commande/{reference}', name: 'account_order_show')]
    public function show($reference): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByReference($reference);
        if(!$order || $order->getUser() != $this->getUser())
        {
            return $this->redirectToRoute('account_order');
        }
        return $this->render('account/order_show.html.twig',[
            'order'=>$order
        ]);
    }

}