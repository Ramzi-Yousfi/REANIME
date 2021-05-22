<?php

namespace App\Controller\User;

use App\Classe\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetController extends AbstractController
{
    private $entiyManager;


    public function __construct(EntityManagerInterface $entiyManager)
    {
        $this->entiyManager = $entiyManager;
    }

    #[Route('/mot-de-passe-oublier', name: 'reset_password')]
    public function index(Request $request): Response
    {
        $notification=null;


        if ($this->getUser()){
            $this->redirectToRoute('home');
        }
        if($request->get('email')){
          $user = $this->entiyManager->getRepository(User::class)->findOneByEmail($request->get('email'));
          if($user){
              $reset_password = new ResetPassword();
              $reset_password->setUser($user);
              $reset_password->setToken(uniqid());
              $reset_password->setCreatedAt(new \DateTime());
              $this->entiyManager->persist($reset_password);
              $this->entiyManager->flush();

              $url = $this->generateUrl('update_password',[
                 'token' => $reset_password->getToken()
              ]);
              $domain = $_SERVER['HTTP_ORIGIN'];


              $content = "Bonjour ".$user->getFirstname()."Vous avez demandé à réinitialiser votre mot de passe sur le site REANIME .<br/><br/><a href=\"https://github.com/Ramzii-Dev\">hello</a>";
              $content .="Merci de bien vouloir cliquer <a href='".$domain.$url."'> ICI </a> pour mettre à jour votre mot de passe .<br/><br/>";


              $mail = new Mail();
              $mail->send($user->getEmail(),$user->getFirstname().' '.$user->getLastname(),'Réinitialisation mot de passe  REANIME',$content);
              $notification = 'un email de réinitialisation viens de vous etre envoyé. ';
          }else{
              $this->addFlash('notice','Cette adresse email est inconnue. ');
          }
        }
        return $this->render('reset/index.html.twig', [
        'notification'=>$notification
        ]);
    }
    #[Route('/modifier-mot-de-passe/{token}', name: 'update_password')]
    public function update(Request $request,$token,UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;

        $reset_password = $this->entiyManager->getRepository(ResetPassword::class)->findOneByToken($token);
        if(!$reset_password){
            $this->redirectToRoute('reset_password');
        }
        $now = new \DateTime();
        if ($now <$reset_password->getCreatedAt()->modify('+ 12 hour')){
            $this->addFlash('notice','Votre demande de changement de mot de passe a expiré.merci de la renouveller ');
            $this->redirectToRoute('reset_password');
        }
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
          $new_pwd = $form->get('new_password')->getData();
          $password = $encoder->encodePassword($reset_password->getUser(),$new_pwd);
          $reset_password->getUser()->setPassword($password);
          $this->entiyManager->flush();
            $this->addFlash('alert','Votre mot de passe à bien été mis à jour. ');
           return $this->redirectToRoute('app_login');

        }
        return $this->render('reset/update.html.twig', [
        'form'=>$form->createView(),
        ]);

    }

}
