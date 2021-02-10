<?php

namespace App\Controller\Admin;

use App\Entity\Teacher;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class TeacherCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Teacher::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('email'),
            AssociationField::new('groups'),
        ];
    }
}
