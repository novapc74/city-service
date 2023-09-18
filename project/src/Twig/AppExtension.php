<?php

namespace App\Twig;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use App\Repository\SocialNetworkRepository;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    private const VALID_EXTENSION = [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'video/mp4',
        'application/pdf',
    ];

    public function __construct(private readonly ContactRepository       $contactRepository,
                                private readonly SocialNetworkRepository $socialNetworkRepository)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('contact', [$this, 'getContact']),
            new TwigFunction('socialNetworks', [$this, 'getSocialNetworks']),
            new TwigFunction('menuLinks', [$this, 'getMenuLinks']),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('mimeTypeName', [$this, 'getMimeTypeName']),
        ];
    }
    public function getMimeTypeName($mimeType = null): string
    {
        if(in_array($mimeType, self::VALID_EXTENSION)) {
            $mimeType = explode('/', $mimeType);

            return strtoupper(end($mimeType));
        }

        return 'FILE';
    }

    public function getContact(): ?Contact
    {
        return $this->contactRepository->findOneBy([]);
    }

    public function getSocialNetworks(): array
    {
        return $this->socialNetworkRepository->findAll();
    }

    public function getMenuLinks(): array
    {
        return [
            [
                'name' => 'главная',
                'link' => 'app_home',
            ],
            [
                'name' => 'контакты',
                'link' => 'app_contact',
            ],
            [
                'name' => 'о нас',
                'link' => 'app_about',
            ],
            [
                'name' => 'политика',
                'link' => 'app_policy',
            ],
        ];
    }
}