<?php

namespace App\Controller\Account;

use App\Form\ChangeAvatarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAvatarController extends AbstractController
{
    #[Route('/compte/modifier-avatar', name: 'account_avatar')]
    public function index(Request $request , EntityManagerInterface $entityManager): Response
    {
        $notification = null;
        $user =$this->getUser();
        $form=$this->createForm(ChangeAvatarType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
                $file = $request->files->get('change_avatar')['avatar'];
                $uploads_directory =$this->getParameter('upload_directory');
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $uploads_directory,$filename
                );
                $user->setavatar($filename);
                $entityManager->persist($user);
                $entityManager->flush();
                $notification = 'votre photo de profil a bien été modifier';
        }
        return $this->render('account/avatar.html.twig', [
           'form'=>$form->createView(),
            'notification'=>$notification
        ]);
    }
}
