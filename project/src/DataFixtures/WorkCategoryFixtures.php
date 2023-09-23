<?php

namespace App\DataFixtures;

use App\Entity\WorkCategory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class WorkCategoryFixtures extends BaseFixture implements DependentFixtureInterface
{
    private const CATEGORY_DATA = [
        [
            [
                'title' => 'Пулково',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
            ],
            [
                'title' => 'Домодедово',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
            ],
        ],
        [
            [
                'title' => 'Москва Сити',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
            ],
            [
                'title' => 'Морская Столица',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
            ]
        ],
        [
            [
                'title' => 'Сбер Банк',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
            ],
            [
                'title' => 'Альфа Банк',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
            ]
        ]
    ];

    private const CATEGORY_TITLE = ['АЭРОПОРТЫ', 'БИЗНЕС-ЦЕНТРЫ', 'БАНКИ'];

    public function loadData(ObjectManager $manager): void
    {
        $this->createEntity(WorkCategory::class, 3, function (WorkCategory $category, $count) {

            $completedWorkFirst = $this->createReference(
                self::CATEGORY_DATA[$count][0]['title'],
                self::CATEGORY_DATA[$count][0]['description']
            );
            $completedWorkSecond = $this->createReference(
                self::CATEGORY_DATA[$count][1]['title'],
                self::CATEGORY_DATA[$count][1]['description']
            );

            $category
                ->setTitle(self::CATEGORY_TITLE[$count])
                ->addCompletedWork($completedWorkFirst)
                ->addCompletedWork($completedWorkSecond);
        });

        $manager->flush();
    }

    private function createReference(string $title, string $description): WorkCategory
    {
        return (new WorkCategory())
            ->setTitle($title)
            ->setDescription($description);
    }

    public function getDependencies(): array
    {
        return [
            CertificateFixtures::class
        ];
    }
}
