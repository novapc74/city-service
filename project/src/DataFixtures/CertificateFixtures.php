<?php

namespace App\DataFixtures;

use App\Entity\Certificate;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CertificateFixtures extends BaseFixture implements FixtureGroupInterface
{
    private const CERTIFICATE_DATA = [
        [
            'title' => 'Сертификат 1',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
        ],
        [
            'title' => 'Сертификат 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
        ],
        [
            'title' => 'Сертификат 3',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci amet, aperiam cumque harum magnam non quibusdam quis recusandae tenetur? Ad commodi corporis dolor doloremque earum laudantium repudiandae tenetur. Earum.'
        ],
    ];
    public function loadData(ObjectManager $manager): void
    {
        $this->createEntity(Certificate::class, 3, function (Certificate $certificate, $count) {
            $certificate
                ->setTitle(self::CERTIFICATE_DATA[$count]['title'])
                ->setDescription(self::CERTIFICATE_DATA[$count]['description']);
        });

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return [
            AdvantageFixtures::class
        ];
    }
}
