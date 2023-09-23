<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BranchFixtures extends BaseFixture implements DependentFixtureInterface
{
	private const BRANCH_DATA = [
		[
			'city' => 'Москва',
			'address' => 'Москва, ул. Ботаническая, дом 41 корпус 7',
			'link' => 'https:/google.com',
		],
		[
			'city' => 'Петрозаводстк',
			'address' => 'Москва, ул. Ботаническая, дом 41 корпус 7',
			'link' => 'https:/google.com',
		],
		[
			'city' => 'Великий Новгород',
			'address' => 'Москва, ул. Ботаническая, дом 41 корпус 7',
			'link' => 'https:/google.com',
		],
		[
			'city' => 'Псков',
			'address' => 'Москва, ул. Ботаническая, дом 41 корпус 7',
			'link' => 'https:/google.com',

		],
		[
			'city' => 'Мурманск',
			'address' => 'Москва, ул. Ботаническая, дом 41 корпус 7',
			'link' => 'https:/google.com',
		],
	];

	public function loadData(ObjectManager $manager): void
	{
		$this->createEntity(Branch::class, 5, function (Branch $branch, $count) {
			$branch
				->setCity(self::BRANCH_DATA[$count]['city'])
				->setAddress(self::BRANCH_DATA[$count]['address'])
				->setLink(self::BRANCH_DATA[$count]['link']);
		});

		$manager->flush();
	}

	public function getDependencies(): array
	{
		return [
			ContactFixtures::class
		];
	}
}
