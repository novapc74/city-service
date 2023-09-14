<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class BranchFixtures extends BaseFixture implements FixtureGroupInterface
{
	private const BRANCH_DATA = [
		[
			'city' => 'Москва',
			'address' => 'Москва',
		],
		[
			'city' => 'Петрозаводстк',
			'address' => 'Петрозаводстк',
		],		[
			'city' => 'Великий Новгород',
			'address' => 'Великий Новгород',
		],		[
			'city' => 'Псков',
			'address' => 'Псков',
		],		[
			'city' => 'Мурманск',
			'address' => 'Мурманск',
		],
	];
	public function loadData(ObjectManager $manager): void
	{
		$this->createEntity(Branch::class, 5, function (Branch $branch, $count) {
			$branch
				->setCity(self::BRANCH_DATA[$count]['city'])
				->setAddress(self::BRANCH_DATA[$count]['address']);
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
