<?php


namespace App\Classe;


use App\Entity\ProductCategory;


class SearchProduct
{
    /**
     * @var string
     */
    public $string='';
    /**
     * @var ProductCategory[]
     */
    public $categories=[];
    /**
     * @var Integer
     */
    public $minPrice;
    /**
     * @var Integer
     */
    public $maxPrice;

}