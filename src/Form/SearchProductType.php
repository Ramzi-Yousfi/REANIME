<?php


namespace App\Form;


use App\classe\SearchProduct;


use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('string',TextType::class,[
                'label'=>false,
                'required' => false,
                'attr'=>[
                    'placeholder'=>'votre recherche .....'
                ]
            ])
            ->add('categories',EntityType::class,[
                'label'=>false,
                'required'=>false,
                'class'=>ProductCategory::class,
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('minPrice',IntegerType::class,[
                'label'=>'min',
                'required' => false,
            ])
            ->add('maxPrice',IntegerType::class,[
                'label'=>'max',
                'required' => false,
            ])
            ->add('filtrer',SubmitType::class,[
                'label'=>'rechercher',
                'attr'=>[
                    'class'=>'btn-block btn-primary'
                ]
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchProduct::class,
            'method'=>'GET',
            'crsf_protection'=>false,
            'validation_groups'=>false,
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}