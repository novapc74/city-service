<?php

namespace App\DataFixtures;


use App\Entity\Service;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends BaseFixture implements DependentFixtureInterface
{
    private const EXPERTIZE = [
        'Заводы', 'Фабрики', 'Склады', 'Цеха', 'Логистические центры', 'Бизнес центры',
        'Пищевая промышленность', 'Торговые центры', 'Гипермаркеты', 'Супермаркеты',
        'Аэропорты', 'Медицинские центры', 'Вокзалы', 'Больницы', 'Таможни',
        'Университеты', 'Школы', 'Уборка территорий', 'и другие',
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createEntity(Service::class, 1, function (Service $service) {

            for ($i = 0; $i < 3; $i++) {
                $workCategory = $this->getReference("WorkCategory_$i");
                $service->addWorkCategory($workCategory);
            }

            $service
                ->setTitle('Клининг')
                ->setDescription('<p>ПРОФЕССИОНАЛЬНАЯ УБОРКА ДЛЯ ВАШЕГО БИЗНЕСА</p>')
                ->setExpertise(self::EXPERTIZE)
                ->addAbout($this->setAboutService())
                ->setIsActive(true)
                ->setProduct($this->getReference('Product_0'));
        });

        $manager->flush();
    }

    private function setAboutService(): Service
    {
        return (new Service())
            ->setTitle('НАШИ КЛИНИНГОВЫЕ УСЛУГИ ПРЕДСТАВЛЯЮТ СОБОЙ КАЧЕСТВЕННОЕ ОБСЛУЖИВАНИЕ ДЛЯ ВАШЕГО БИЗНЕСА')
            ->setDescription('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam facilis harum illum impedit ipsam optio quibusdam reprehenderit sapiente! Alias aliquid dicta dolorem doloremque, ea labore odio ut! Aut, nemo, sapiente?</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam facilis harum illum impedit ipsam optio quibusdam reprehenderit sapiente! Alias aliquid dicta dolorem doloremque, ea labore odio ut! Aut, nemo, sapiente?</p>');
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
        ];
    }
}
