<?php

namespace App\Controller\News;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class NewsController extends AbstractController
{
    private $entiyManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entiyManager =$entityManager;
    }

    #[Route('/actualité', name: 'news')]
    public function index(): Response
    {
        $news = $this->entiyManager->getRepository(News::class)->findByLastNews(10);
        return $this->render('news/index.html.twig', [
           'news'=>$news
        ]);
    }
    #[Route('/actualité/{title}', name: 'news-view')]
    public function view($title): Response
    {
        $newsView = $this->entiyManager->getRepository(News::class)->findOneByTitle($title);
        if (!$newsView){
            $this->redirectToRoute('news');
        }
        return $this->render('news/view.html.twig', [
            'news'=>$newsView
        ]);
    }
}
