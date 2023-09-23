<?php

namespace App\DataFixtures;


use App\Entity\Advantage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdvantageFixtures extends BaseFixture implements DependentFixtureInterface
{
    private const ADVANTAGE_DATA = [
        [
            'title' => 'КАЧЕСТВО',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
        ],
        [
            'title' => 'НАДЕЖНОСТЬ',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
        ],
        [
            'title' => 'ИННОВАЦИИ',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
        ],
    ];
    public function loadData(ObjectManager $manager): void
    {
        $this->createEntity(Advantage::class, 3, function (Advantage $advantage, $count) {
            $advantage
                ->setTitle(self::ADVANTAGE_DATA[$count]['title'])
                ->setDescription(self::ADVANTAGE_DATA[$count]['description']);
        });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ReviewFixtures::class
        ];
    }
}
