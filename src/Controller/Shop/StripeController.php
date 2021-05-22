<?php

namespace App\Controller\Shop;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/commande/create-session/{reference}', name: 'stripe_create_session')]
    public function index(EntityManagerInterface $entityManager, Cart $cart ,$reference): Response
    {     $YOUR_DOMAIN = 'https://127.0.0.1:8000';
        //TODO change the domain name before prod
        $products_for_stripe=[];

        $order = $entityManager->getRepository(Order::class)->findOneByReference($reference);
        if (!$order){
            new JsonResponse(['error'=>'order']);
        }


        foreach ($order->getOrderDetails()->getValues() as $product){
            $product_object = $entityManager->getRepository(Product::class)->findOneBySlug($product->getProduct());
            $products_for_stripe[]=[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product->getPrice(),
                    'product_data' => [
                        'name' => $product->getProduct(),
                        'images' => [$YOUR_DOMAIN."/uploads/".$product_object->getIllustration()],
                    ],
                ],
                'quantity' => $product->getQuantity(),
            ];
        }
        $products_for_stripe[]=[
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $order->getCarrierPrice(),
                'product_data' => [
                    'name' => $order->getCarrierName(),
                    'images' => [$YOUR_DOMAIN."/uploads/".$order->getCarrierIllustration()],
                ],
            ],
            'quantity' => 1,
        ];

        Stripe::setApiKey('sk_test_51Imf9aHkgexrIntIXisEyVTMD1PTXMfWYSjSYl93Yav7953upEaCJTM3nOy9Dcqj7w8T6uqRR3pKVnIgOMCK3FOU00GFZffGJJ');
        $YOUR_DOMAIN = 'https://127.0.0.1:8000';
        $checkout_session =Session::create([
            'customer_email'=>$this->getUser()->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [
                $products_for_stripe
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/commande/success/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/commande/cancel/{CHECKOUT_SESSION_ID}',
        ]);
        $order->setStripeSessionId($checkout_session->id);
        $entityManager->flush();
        $response = new JsonResponse(['id'=>$checkout_session->id]);
        return $response;
    }
}
