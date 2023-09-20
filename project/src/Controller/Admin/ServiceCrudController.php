<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use Doctrine\ORM\QueryBuilder;
use App\Form\Admin\GalleryType;
use App\Form\Admin\AboutServiceFormType;
use App\Form\Admin\ServiceBlockFormType;
use Psr\Container\NotFoundExceptionInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Psr\Container\ContainerExceptionInterface;
use Symfony\Component\Validator\Constraints\Count;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Service::class;
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			FormField::addTab('Основное'),
			TextField::new('title', 'Заголовок')
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
			,
			FormField::addRow(),
			SlugField::new('slug', 'Слаг')
				->setTargetFieldName('title')
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
			,
			FormField::addRow(),
			TextEditorField::new('description', 'Описание')
				->setFormType(CKEditorType::class)
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
			,
			FormField::addTab('Галерея'),
			TextField::new('image', 'Файлы')
				->onlyOnIndex()
				->setTemplatePath('admin/crud/assoc_gallery.html.twig')
			,
			CollectionField::new('gallery', 'Картинки')
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
				->setEntryType(GalleryType::class)
				->setFormTypeOptions([
					'by_reference' => false,
					'error_bubbling' => false,
				])
				->renderExpanded()
				->onlyOnForms()
			,
			FormField::addTab('Экспертизы'),
			CollectionField::new('expertise', 'Экспертизы')
				->setTextAlign('center')
				->setColumns('col-sm-6 col-lg-5 col-xxl-3')
			,
			FormField::addTab('О нас'),
			CollectionField::new('about', false)
				->setEntryType(AboutServiceFormType::class)
				->setTextAlign('center')
				->setFormTypeOptions([
					'constraints' => [
						new Count([
							'min' => 1,
							'max' => 1,
						])
					]
				])
			,
			FormField::addTab('Сервисы'),
			CollectionField::new('services', false)
				->setEntryType(ServiceBlockFormType::class)
				->setTextAlign('center')
			,
			FormField::addTab('Кейсы'),
			CollectionField::new('cases', false)
				->setEntryType(ServiceBlockFormType::class)
				->setTextAlign('center')
			,
			FormField::addTab('Блоки')
			,
		];
	}

	/**
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
	{
		$repository = $this->container->get(EntityRepository::class);

		return $repository->createQueryBuilder($searchDto, $entityDto, $fields, $filters)
			->andWhere('entity.aboutService is null')
			->andWhere('entity.parentService is null')
			->andWhere('entity.caseService is null');
	}
}
