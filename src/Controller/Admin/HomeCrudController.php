<?php

namespace App\Controller\Admin;

use App\Entity\Home;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Home::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            ImageField::new('section1Image')
                ->setBasePath('image/')
                ->setUploadDir('public\image')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('section1Titre'),
            TextareaField::new('section1Text'),
            TextField::new('section2Titre'),
            TextareaField::new('section2Text1'),
            TextareaField::new('section2Text2'),
        ];
    }

}
