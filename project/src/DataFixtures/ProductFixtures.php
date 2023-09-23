<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends BaseFixture implements DependentFixtureInterface
{
    private const CHILD_PRODUCT_DATA = [
        [
            'title' => 'Первая услуга',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam facilis harum illum impedit ipsam optio quibusdam reprehenderit sapiente! Alias aliquid dicta dolorem doloremque, ea labore odio ut! Aut, nemo, sapiente?'
        ],
        [
            'title' => 'Вторая услуга',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam facilis harum illum impedit ipsam optio quibusdam reprehenderit sapiente! Alias aliquid dicta dolorem doloremque, ea labore odio ut! Aut, nemo, sapiente?'
        ],
        [
            'title' => 'Третья услуга',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam facilis harum illum impedit ipsam optio quibusdam reprehenderit sapiente! Alias aliquid dicta dolorem doloremque, ea labore odio ut! Aut, nemo, sapiente?'
        ],
        [
            'title' => 'Четвертая услуга',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam facilis harum illum impedit ipsam optio quibusdam reprehenderit sapiente! Alias aliquid dicta dolorem doloremque, ea labore odio ut! Aut, nemo, sapiente?'
        ],
    ];

    public function loadData(ObjectManager $manager): void
    {
        $this->createEntity(Product::class, 1, function (Product $product) {
            $product
                ->setTitle('Делаем жизнь людей проще')
                ->setDescription('Мы применяем инновационные методы, такие как наноочистка через нанотехнологии, обеспечиваю глубокую молекулярную...');

            for ($i = 0; $i < 4; $i++) {
                $product->addProduct($this->createChildProduct($i));
            }

        });

        $manager->flush();
    }

    private function createChildProduct($count): Product
    {
        return (new Product())
            ->setTitle(self::CHILD_PRODUCT_DATA[$count]['title'])
            ->setDescription(self::CHILD_PRODUCT_DATA[$count]['description']);
    }

    public function getDependencies(): array
    {
        return [
            WorkCategoryFixtures::class,
        ];
    }
}
