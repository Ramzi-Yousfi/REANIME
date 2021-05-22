<?php


namespace App\Classe;


use App\Entity\Genre;
use App\Entity\VideoCategory;

class SearchAnime
{

    /**
     * @var string
     */
    public $string='';
    /**
     * @var VideoCategory[]
     */
    public $categories=[];

    /**
     * @var Genre[]
     */
    public $genres=[];

}