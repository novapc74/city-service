<?php

namespace App\Controller\Admin;

use App\Entity\WorkCategory;
use App\Form\Admin\GalleryType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class WorkCategoryCrudController extends AbstractCrudController
{
    public function __construct(private readonly EntityManagerInterface $entityManager,
                                private readonly AdminUrlGenerator      $adminUrlGenerator,
                                private readonly RequestStack           $requestStack)
    {
    }

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

    public function configureActions(Actions $actions): Actions
    {
        $addCompletedWork = Action::new('add completed work', 'Добавить работу')
            ->displayAsLink()
            ->displayIf(fn(WorkCategory $workCategory) => !$workCategory->getCategory())
            ->linkToCrudAction('addCompletedWork');

        $showCompletedWorks = Action::new('show completed works', 'Показать работы')
            ->displayAsLink()
            ->displayIf(fn(WorkCategory $workCategory) => $workCategory->getCompletedWorks()->count())
            ->linkToCrudAction('showCompletedWorks');

        $comeBack = Action::new('come back to parent category', 'Вернуться')
            ->displayAsLink()
            ->displayIf(fn(WorkCategory $category) => $category->getCategory())
            ->linkToCrudAction('comeBackToParentCategory');

        return parent::configureActions($actions)
            ->add('index', $addCompletedWork)
            ->add('index', $showCompletedWorks)
            ->add('index', $comeBack);
    }

    public function comeBackToParentCategory(AdminContext $context): RedirectResponse
    {
        /**@var WorkCategory $currentCategory */
        $currentCategory = $context->getEntity()->getInstance();

        $url = $this->adminUrlGenerator->unsetAll()
            ->setController(WorkCategoryCrudController::class)
            ->setAction('index')
            ->set('entity_id', $currentCategory->getCategory()->getId())
            ->generateUrl();

        return $this->redirect($url);
    }

    public function showCompletedWorks(AdminContext $context): RedirectResponse
    {
        /**@var WorkCategory $currentCategory */
        $currentCategory = $context->getEntity()->getInstance();
        $idCompletedWoks = $currentCategory->getCompletedWorks()->map(fn(WorkCategory $completedWork) => $completedWork->getId())->toArray();

        $url = $this->adminUrlGenerator->unsetAll()
            ->setController(WorkCategoryCrudController::class)
            ->setAction('index')
            ->set('entity_id', implode(',', $idCompletedWoks))
            ->generateUrl();

        return $this->redirect($url);
    }

    public function addCompletedWork(AdminContext $context): RedirectResponse
    {
        $newCompletedWork = (new WorkCategory())->setTitle('');

        /**@var WorkCategory $currentCategory */
        $currentCategory = $context->getEntity()->getInstance();
        $currentCategory->addCompletedWork($newCompletedWork);

        $this->entityManager->persist($newCompletedWork);
        $this->entityManager->flush();

        $url = $this->adminUrlGenerator->unsetAll()
            ->setController(WorkCategoryCrudController::class)
            ->setAction('edit')
            ->setEntityId($newCompletedWork->getId())
            ->generateUrl();

        return $this->redirect($url);
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
        ];
    }

    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        /**@var WorkCategory $category */
        $category = $context->getEntity()->getInstance();

        if ($parentCategory = $category->getCategory()) {
            $idCategoryCollection = $parentCategory->getCompletedWorks()->map(fn(WorkCategory $completedWork) => $completedWork->getId())->toArray();

            $url = $this->adminUrlGenerator->unsetAll()
                ->setController(WorkCategoryCrudController::class)
                ->setAction('index')
                ->set('entity_id', implode(',', $idCategoryCollection))
                ->generateUrl();

            return $this->redirect($url);
        }

        return parent::getRedirectResponseAfterSave($context, $action);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $repository = $this->container->get(EntityRepository::class);
        $query = $this->requestStack->getCurrentRequest()->query;

        if ($query->has('entity_id')) {
            $idCollection = $query->get('entity_id');

            return $repository->createQueryBuilder($searchDto, $entityDto, $fields, $filters)
                ->andWhere('entity IN (:val)')
                ->setParameter('val', explode(',', $idCollection));
        }

        return $repository->createQueryBuilder($searchDto, $entityDto, $fields, $filters)
            ->andWhere('entity.category is null');
    }
}
