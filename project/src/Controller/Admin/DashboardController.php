<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Service;
use App\Entity\Advantage;
use App\Entity\Branch;
use App\Entity\Certificate;
use App\Entity\Gallery;
use App\Entity\Review;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Feedback;
use App\Entity\WorkCategory;
use App\Entity\SocialNetwork;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SectionMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
	public function __construct(private readonly ManagerRegistry   $managerRegistry,
	                            private readonly AdminUrlGenerator $adminUrlGenerator)
	{
	}

	#[Route('/admin', name: 'admin')]
	public function admin(): Response
	{
		return $this->render('@EasyAdmin/page/content.html.twig');
	}

	public function configureDashboard(): Dashboard
	{
		return Dashboard::new()
			->setTitle('<span style="color: red">City Service</span>');
	}

	public function configureCrud(): Crud
	{
		return parent::configureCrud()
			->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
	}

	public function configureMenuItems(): iterable
	{
		yield MenuItem::linkToCrud('Пользователи', 'fa-solid fa-user', User::class);

		yield MenuItem::section();
		yield MenuItem::linkToCrud('Обратная связь', 'fa-solid fa-comment', Feedback::class);

		yield MenuItem::section('контакты');
		yield MenuItem::linkToCrud('Контакты', 'fa-regular fa-address-card', Contact::class);
		yield MenuItem::linkToCrud('Соц.сети', 'fa-brands fa-twitter', SocialNetwork::class);
		yield MenuItem::linkToCrud('Филиалы', 'fa-solid fa-code-branch', Branch::class);

        yield MenuItem::section();
        yield MenuItem::linkToCrud('Отзывы', 'fa-solid fa-file-pdf', Review::class);
        yield MenuItem::linkToCrud('Преимущества', 'fa-solid fa-jet-fighter', Advantage::class);
        yield MenuItem::linkToCrud('Сертификаты', 'fa-solid fa-certificate', Certificate::class);

		yield MenuItem::section();
		yield MenuItem::linkToCrud('Группы услуг', 'fa-solid fa-bell-concierge', Service::class);
		yield MenuItem::linkToCrud('Категории работ', 'fa-solid fa-briefcase', WorkCategory::class);
        yield MenuItem::linkToCrud('Продукты', 'fa-solid fa-briefcase', Product::class);


//        yield MenuItem::section('Секции на страницах', 'fa-sharp fa-solid fa-puzzle-piece');
//        foreach (self::getSectionMenu() as [$label, $icon, $url]) {
//            yield MenuItem::linkToUrl($label, $icon, $url);
//        }
	}

//    private function getSectionMenu(): array
//    {
//        $dataSectionMenu = [];
//
//        $dataSectionMenu['Добавить секцию'] = [
//            'Добавить секцию',
//            'fa-solid fa-plus',
//            $this->adminUrlGenerator
//                ->unsetAll()
//                ->setController(PageSectionCrudController::class)
//                ->setAction(Crud::PAGE_INDEX)
//                ->generateUrl()
//        ];
//
//        foreach ($this->managerRegistry->getRepository(PageSection::class)->findAll() as $section) {
//            $sectionType = array_search($section->getType(), PageSection::getAvailableSectionType());
//            if (!array_key_exists($sectionType, $dataSectionMenu)) {
//                $url = $this->adminUrlGenerator
//                    ->unsetAll()
//                    ->setController(PageSectionCrudController::class)
//                    ->setAction(Crud::PAGE_INDEX)
//                    ->set('type', $section->getType())
//                    ->generateUrl();
//
//                $dataSectionMenu[$sectionType] = [$sectionType, false, $url];
//            }
//        }
//
//        return $dataSectionMenu;
//    }
}
