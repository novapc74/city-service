<?php

namespace App\Controller\Admin;

use App\Entity\WorkCategory;
use App\Form\Admin\CompletedWorkType;
use App\Form\Admin\GalleryType;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class WorkCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Категорию работ')
            ->setPageTitle('edit', 'Редактировать категорию')
            ->setPageTitle('new', 'Создать категорию')
            ->setEntityLabelInPlural('Категории работ');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Основное'),
            TextField::new('title', 'Заголовок')
                ->setTextAlign('center')
                ->setColumns('col-sm-6 col-lg-5 col-xxl-3')
            ,
            FormField::addTab('Галерея'),
            TextField::new('image', 'Файлы')
                ->onlyOnIndex()
                ->setTemplatePath('admin/crud/assoc_gallery.html.twig')
            ,
            CollectionField::new('gallery', false)
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
            FormField::addTab('Выполненные работы'),
            CollectionField::new('completedWorks', false)
                ->setEntryType(CompletedWorkType::class)
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'error_bubbling' => false,
                ])
                ->renderExpanded()
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
            ->andWhere('entity.category is null');
    }
}
