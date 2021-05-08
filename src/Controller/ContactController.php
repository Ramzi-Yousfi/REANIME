<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {
        $form =$this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isSubmitted()){
            $this->addFlash('notice','merci de nous avoir contacter');
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form'=>$form->createView()
        ]);
    }
}
