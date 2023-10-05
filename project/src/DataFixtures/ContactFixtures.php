<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends BaseFixture implements DependentFixtureInterface
{
	public function loadData(ObjectManager $manager): void
	{
		$this->createEntity(Contact::class, 1, function (Contact $contact) {
			$contact
				->setPhone(['+7 (812) 363-01-09'])
                ->setEmail('info@csclean.net')
				->setAddress('г. Санкт-Петербург, пл. Карла Фаберже, д. 8, литер Б')
				->setInn('7842335089')
				->setCoordinates('59.935574, 30.436045');
		});

		$manager->flush();
	}

	public function getDependencies(): array
	{
		return [
			SocialNetworkFixtures::class
		];
	}
}
