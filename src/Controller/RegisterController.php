<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;


class RegisterController extends AbstractController
{
    private $encoder;
    private $entityManger;
    public function __construct(EntityManagerInterface $entityManger, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManger = $entityManger;
        $this->encoder = $encoder;
    }
    #[Route('/inscription', name: 'register')]
    public function index(Request $request)
    {
        date_default_timezone_set('UTC');
        $month = (int)date('m');
        $notification = null;
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search_email = $this->entityManger->getRepository(User::class)->findOneByEmail($user->getEmail());
            if(!$search_email){
                $user = $form->getData();
                $password = $this->encoder->encodePassword($user, $user->getpassword());
                $user->setPassword($password);
                $user->setMonth($month);
                $this->entityManger->persist($user);
                $this->entityManger->flush();
                $notification ="merci pour votre inscription !";

                header( "refresh:4; /" );
            }else{
                $notification ="L'email que vous avez utilisez existe deja !";
            }
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification'=>$notification

        ]);

    }
}

