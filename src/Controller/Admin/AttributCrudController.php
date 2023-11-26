<?php

namespace App\Controller\Admin;

use App\Entity\Attribut;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AttributCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribut::class;
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
