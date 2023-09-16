<?php

namespace App\Controller\Admin;

use App\Entity\Advantage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class AdvantagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Advantage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Преимущество')
            ->setEntityLabelInPlural('Преимущества');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Заголовок')
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
            ,
            FormField::addRow(),
            TextEditorField::new('description', 'Описание')
                ->setFormType(CKEditorType::class)
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
            ,
        ];
    }
}
