<?php

namespace App\Controller\Admin;

use App\Entity\ProfilImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfilImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfilImage::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
