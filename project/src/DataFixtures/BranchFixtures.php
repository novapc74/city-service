<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BranchFixtures extends BaseFixture implements DependentFixtureInterface
{
	private const BRANCH_DATA = [
		[
			'city' => 'Санкт-Петербург',
			'address' => 'Санкт-Петербург, пл. Карла Фаберже, д.8, литер Б',
			'link' => 'https://yandex.ru/maps/-/CDUt646n',
		],
		[
			'city' => 'Москва',
			'address' => 'Москва, ул. Ботаническая, д.41, корпус 7',
			'link' => 'https://yandex.ru/maps/-/CDUt6N-B',
		],
		[
			'city' => 'Великий Новгород',
			'address' => 'Великий Новгород, пр-т Мира, д. 32, корпус 1, каб. 337',
			'link' => 'https://yandex.ru/maps/-/CDUt68oJ',
		],
		[
			'city' => 'Мурманск',
			'address' => 'Мурманск, пр-т Кольский, д. 178, офис 1, ДБ «Жемчуг»',
			'link' => 'https://yandex.ru/maps/-/CDUt68-V',

		],
		[
			'city' => 'Петрозаводск',
			'address' => 'Петрозаводск, ул. Калинина, д. 4',
			'link' => 'https://yandex.ru/maps/-/CCU67WRasB',
		],
        [
            'city' => 'Псков',
            'address' => 'Псков, ул. Некрасова, д. 7/11',
            'link' => 'https://yandex.ru/maps/-/CDUt66Y~',
        ],
        [
            'city' => 'Сыктывкар',
            'address' => 'Сыктывкар, М. Дырнос, д. 98/1, лит.Б, корпус 5',
            'link' => 'https://yandex.ru/maps/-/CDUt66Pp',
        ],
        [
            'city' => 'Ярославль',
            'address' => 'Ярославль, пр-т Ленина, д. 44, оф. 102',
            'link' => 'https://yandex.ru/maps/-/CDUt6CNN',
        ],
        [
            'city' => 'Волгоград',
            'address' => 'Волгоград, ул. Пугачевская, д. 9Б, оф. 16',
            'link' => 'https://yandex.ru/maps/-/CDUt6Ckx',
        ],
        [
            'city' => 'Тольятти',
            'address' => 'Тольятти, ул. Маршала Жукова, д. 35, оф. 11',
            'link' => 'https://yandex.ru/maps/-/CDUt6Cpg',
        ],
        [
            'city' => 'Калуга',
            'address' => 'Калуга, ул. Газовая, д. 3',
            'link' => 'https://yandex.ru/maps/-/CDUt6Gmc',
        ],
        [
            'city' => 'Омск',
            'address' => 'Омск, ул. Декабристов, д. 45, оф. 209',
            'link' => 'https://yandex.ru/maps/-/CDUt6Gzt',
        ],
        [
            'city' => 'Архангельск',
            'address' => 'Архангельск, пр-т Ломоносова, д. 81 оф. 510',
            'link' => 'https://yandex.ru/maps/-/CDUt6GLY',
        ],
	];

	public function loadData(ObjectManager $manager): void
	{
		$this->createEntity(Branch::class, 13, function (Branch $branch, $count) {
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
