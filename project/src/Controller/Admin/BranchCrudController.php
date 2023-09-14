<?php

namespace App\Controller\Admin;

use App\Entity\Branch;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BranchCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Branch::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			->setEntityLabelInSingular('Филиал')
			->setEntityLabelInPlural('Филиалы');
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			TextField::new('city', 'Город')
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
			,
			FormField::addRow(),
			SlugField::new('slug', 'Слаг')
				->setTargetFieldName('city')
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
			,
			FormField::addRow(),
			TextareaField::new('address', 'Адрес')
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
			,
		];
	}
}
