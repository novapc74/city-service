<?php

namespace App\Controller\Admin;

use App\Entity\Certificate;
use App\Form\Admin\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class CertificateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Certificate::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Сертификат')
            ->setEntityLabelInPlural('Сертификаты');
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
            FormField::addRow(),
	        TextField::new('preview', 'Превью')
		        ->setTemplatePath('admin/crud/assoc_image.html.twig')
	        ,
	        FormField::addPanel('Превью')
		        ->setProperty('preview')
		        ->setTextAlign('center')
		        ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
		        ->setFormType(MediaType::class)
		        ->setFormTypeOptions([
			        'mapped' => true
		        ])
	        ,
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
	        ,
        ];
    }

}
