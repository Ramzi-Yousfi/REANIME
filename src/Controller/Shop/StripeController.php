<?php

namespace App\Controller\Shop;

use App\Classe\Cart;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/commande/create-session', name: 'stripe_create_session')]
    public function index(Cart $cart): Response
    {     $YOUR_DOMAIN = 'https://127.0.0.1:8000';
        //TODO change the domain name before prod
        $products_for_stripe=[];

        foreach ($cart->getFull() as $product){
            $products_for_stripe[]=[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product['product']->getPrice(),
                    'product_data' => [
                        'name' => $product['product']->getName(),
                        'images' => [$YOUR_DOMAIN."/uploads/".$product['product']->getIllustration()],
                    ],
                ],
                'quantity' => $product['quantity'],
            ];
        }
        Stripe::setApiKey('sk_test_51Imf9aHkgexrIntIXisEyVTMD1PTXMfWYSjSYl93Yav7953upEaCJTM3nOy9Dcqj7w8T6uqRR3pKVnIgOMCK3FOU00GFZffGJJ');
        $YOUR_DOMAIN = 'https://127.0.0.1:8000';
        $checkout_session =Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $products_for_stripe
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);
        $response = new JsonResponse(['id'=>$checkout_session->id]);
        return $response;
    }
}
