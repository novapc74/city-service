<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReviewFixtures extends BaseFixture implements DependentFixtureInterface
{
    private const REVIEW_DATA = [
        [
            'preview' => 'Компания "Сити Сервис" - мой верный партнер в поддержании безупречного порядка. Они делают свою работу безупречно и ответственно',
            'author' => ['Иван Петров', 'Генеральный директор компании "Акрон"'],
        ],
        [
            'preview' => 'Компания "Сити Сервис" - мой верный партнер в поддержании безупречного порядка. Они делают свою работу безупречно и ответственно',
            'author' => ['Петр Иванов', 'Главный бухгалтер компании "Озон"'],
        ],        [
            'preview' => 'Компания "Сити Сервис" - мой верный партнер в поддержании безупречного порядка. Они делают свою работу безупречно и ответственно',
            'author' => ['Елена Александровна', 'Руководитель отдела продаж компании "Яндех"'],
        ],        [
            'preview' => 'Компания "Сити Сервис" - мой верный партнер в поддержании безупречного порядка. Они делают свою работу безупречно и ответственно',
            'author' => ['Александра Фёдоровна', 'Заместитель директора компании "Автоваз"'],
        ],
        [
            'preview' => 'Компания "Сити Сервис" - мой верный партнер в поддержании безупречного порядка. Они делают свою работу безупречно и ответственно',
            'author' => ['Карина Евгеньевна', 'Генеральный директор компании "Сбер Банк"'],
        ],
        [
            'preview' => 'Компания "Сити Сервис" - мой верный партнер в поддержании безупречного порядка. Они делают свою работу безупречно и ответственно',
            'author' => ['Тимур Валентинович', 'Начальник охраны компании "Почта России"'],
        ],

    ];

    public function loadData(ObjectManager $manager): void
    {
        $this->createEntity(Review::class, 6, function (Review $review, $count) {
            $review
                ->setPreview(self::REVIEW_DATA[$count]['preview'])
                ->setAuthor(self::REVIEW_DATA[$count]['author']);
        });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BranchFixtures::class
        ];
    }
}
