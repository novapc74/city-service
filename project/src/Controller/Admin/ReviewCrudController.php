<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use App\Form\Admin\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Отзыв')
            ->setEntityLabelInPlural('Отзывы');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('preview', 'Название')
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
            ,
            FormField::addRow(),
            CollectionField::new('author', 'Автор')
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
                ->setFormTypeOptions([
                    'error_bubbling' => false,
                ])
                ->setHelp('Первый элемент - имя, второй элемент - должность')
            ,
            FormField::addRow(),
            TextField::new('file', 'Файл')
                ->setTemplatePath('admin/crud/assoc_image.html.twig')
            ,
            FormField::addPanel('Файл')
                ->setProperty('file')
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
                ->setFormType(MediaType::class)
                ->setFormTypeOptions([
                    'mapped' => true
                ])
        ];
    }
}
