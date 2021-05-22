<?php


namespace App\Form;


use App\Classe\SearchAnime;
use App\classe\SearchProduct;


use App\Entity\Category;
use App\Entity\Genre;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\VideoCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchAnimeType extends AbstractType
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
                'class'=>VideoCategory::class,
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('genres',EntityType::class,[
                'label'=>false,
                'required'=>false,
                'class'=>Genre::class,
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('submit',SubmitType::class,[
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
            'data_class' => SearchAnime::class,
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