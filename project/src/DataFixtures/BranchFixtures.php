<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class BranchFixtures extends BaseFixture implements FixtureGroupInterface
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

	public static function getGroups(): array
	{
		return [
			ContactFixtures::class
		];
	}
}
