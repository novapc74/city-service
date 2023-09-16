<?php

namespace App\DataFixtures;


use App\Entity\Advantage;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AdvantageFixtures extends BaseFixture implements FixtureGroupInterface
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

    public static function getGroups(): array
    {
        return [
            ReviewFixtures::class
        ];
    }
}
