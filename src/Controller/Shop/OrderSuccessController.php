<?php
namespace App\Controller\Shop;

use App\Classe\Cart;
use App\Classe\Mail;
use App\Classe\Stock;
use App\Entity\MailContent;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/commande/success/{stripeSessionId}', name: 'order_success')]
    public function index(Cart $cart, $stripeSessionId ,Stock $stock): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if(!$order || $order->getUser() != $this->getUser()){
            $this->redirectToRoute('home');
        }
        //  header( "refresh:5;url=http://127.0.0.1:8000/" );
        if (!$order->getIsPaid()){
            $order->setIsPaid(1);
            $stock->destock($order);
            $cart->remove();
            $this->entityManager->flush();
            $mail = new Mail();
            $content ="votre commande n°".$order->getReference()."est validé<br/> merci pour votre confiance ";
            $mail->send($order->getUser()->getEmail(),$order->getUser()->getUsername(),'Commannde REANIME ',$content);
        }
        return $this->render('order/success.html.twig',[
            'order'=>$order
        ]);
    }
}
