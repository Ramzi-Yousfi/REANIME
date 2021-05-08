<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\MailContent;
use App\Entity\ProfilImage;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\UX\Cropperjs\Factory\CropperInterface;
use Symfony\UX\Cropperjs\Form\CropperType;


class RegisterController extends AbstractController
{
    private $encoder;
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
    }
    #[Route('/inscription', name: 'register')]
    public function index(Request $request,CropperInterface $cropper)
    {
        date_default_timezone_set('UTC');
        $month = (int)date('m');
        $notification = null;
        $error = null;
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());
            if(!$search_email){
                $file = $request->files->get('register')['avatar'];
                if ($file){
                    $uploads_directory =$this->getParameter('upload_directory');
                    $filename = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $uploads_directory,$filename
                    );
                    $user->setavatar($filename);
                }
                if(!$file){
                    $user->setavatar('868c29f221b596502c644864b83b41fe.png');
                }

                $user = $form->getData();
                $password = $this->encoder->encodePassword($user, $user->getpassword());
                $user->setPassword($password);
                $user->setMonth($month);

                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification ="merci pour votre inscription !";
                $mail = new Mail();
                $content = "Bonjour".$user->getFirstname()."<br/> merci pour votre inscription ";
                $mail->send($user->getEmail(),$user->getUsername(),'Bienvenue sur REANIME',$content);
               // header( "refresh:4; /" );
            }else{
                $error ="L'email que vous avez utilisez existe deja !";
            }
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification'=>$notification,
            'error'=>$error,

        ]);

    }
}

