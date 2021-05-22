<?php


namespace App\Classe;


use App\Entity\Order;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class Stock
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager =$entityManager;
    }
    public function destock(Order $order){
        $orderDetails =$order->getOrderDetails()->getValues();
        foreach ($orderDetails as $key=> $details){
            $product =$this->entityManager->getRepository(Product::class)->findOneBySlug($details->getProduct());
            $newQuantity = $product->getStock() - $details-> getQuantity();
            $product->setStock($newQuantity);
            $this->entityManager->flush();
        }
    }
}