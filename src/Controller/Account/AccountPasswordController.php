<?php

namespace App\Controller\Account;

use App\Form\ChangePasswordType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    /**
     * AccountPasswordController constructor.
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/modifier-mdp', name: 'account_password')]
    public function index(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;
        $user =$this->getUser();
        $form=$this->createForm(ChangePasswordType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $old_pwd = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($user,$old_pwd)){
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user,$new_pwd);

                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification = 'votre mot de passe a bien été modifier';
            }else{
                $notification = 'mot de passe invalide ';
            }
        }
        return $this->render('account/changePassword.html.twig',[
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
