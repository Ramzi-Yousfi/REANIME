<?php


namespace App\Classe;


use App\Entity\Comments;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class comment
{
    private $comment;
    public function __construct(Comments $comment)
    {
      $this->comment = $comment;
    }

    public function addComment(Request $request){
        $commentForm = $this->createForm(ContactType::class,$this->comment);
        $commentForm->handleRequest($request);

  }
}