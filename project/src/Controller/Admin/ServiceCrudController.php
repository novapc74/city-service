<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Service;
use Doctrine\ORM\QueryBuilder;
use App\Form\Admin\GalleryType;
use App\Form\Admin\AboutServiceFormType;
use App\Form\Admin\ServiceBlockFormType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Psr\Container\NotFoundExceptionInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Psr\Container\ContainerExceptionInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Категорию')
            ->setPageTitle('edit', 'Редактировать категорию')
            ->setPageTitle('new', 'Создать категорию')
            ->setEntityLabelInPlural('Категории');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Основное'),
            BooleanField::new('isActive', 'Отображать')
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
                ->onlyOnIndex()
            ,
            TextField::new('title', 'Заголовок')
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
            ,
            TextField::new('subTitle', 'Заголовок для страницы')
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
            TextField::new('image', 'Галерея')
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
                ->setTemplatePath('admin/crud/assoc_description.html.twig')
            ,
            FormField::addTab('Об услуге'),
            CollectionField::new('about', false)
                ->setEntryType(AboutServiceFormType::class)
                ->setTextAlign('center')
                ->setFormTypeOptions([
                    'constraints' => [
                        new Count([
                            'min' => 1,
                            'max' => 1,
                        ])
                    ],
                    'error_bubbling' => false,
                ])
                ->renderExpanded()
                ->onlyOnForms()
            ,
            FormField::addTab('Услуги'),
            AssociationField::new('product', 'Услуги')
                ->setQueryBuilder(fn(QueryBuilder $queryBuilder) => $queryBuilder->where('entity.product is null'))
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
                ->setFormTypeOptions([
                    'mapped' => true,
                ])
            ,
            FormField::addTab('Выполненные работы'),
            AssociationField::new('workCategories', 'Выполненные работы')
                ->setQueryBuilder(fn(QueryBuilder $queryBuilder) => $queryBuilder->where('entity.category is null'))
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
                ->setFormTypeOptions([
                    'by_reference' => false,

                ])
                ->setTemplatePath('admin/crud/assoc_description.html.twig')
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
            ->andWhere('entity.aboutService is null');
    }
}
