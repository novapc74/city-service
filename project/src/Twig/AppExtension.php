<?php

namespace App\Twig;

use App\Entity\Contact;
use App\Entity\Service;
use App\Repository\ContactRepository;
use App\Repository\ServiceRepository;
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

    private const REMOVABLE_CHAR = ['+', '(', ')', ' ', '  ', '-'];

    public function __construct(private readonly ContactRepository       $contactRepository,
                                private readonly SocialNetworkRepository $socialNetworkRepository,
                                private readonly ServiceRepository       $serviceRepository)
    {
    }

    public
    function getFunctions(): array
    {
        return [
            new TwigFunction('contact', [$this, 'getContact']),
            new TwigFunction('socialNetworks', [$this, 'getSocialNetworks']),
            new TwigFunction('menuLinks', [$this, 'getMenuLinks']),
        ];
    }

    public
    function getFilters(): array
    {
        return [
            new TwigFilter('mimeTypeName', [$this, 'getMimeTypeName']),
            new TwigFilter('filterPhoneMask', [$this, 'removePhoneMask']),
        ];
    }

    public function removePhoneMask(string $string): string
    {
        return str_replace(self::REMOVABLE_CHAR, '', $string);
    }

    public function getMimeTypeName($mimeType = null): string
    {
        if (in_array($mimeType, self::VALID_EXTENSION)) {
            $mimeType = explode('/', $mimeType);

            return strtoupper(end($mimeType));
        }

        return 'FILE';
    }

    public
    function getContact(): ?Contact
    {
        return $this->contactRepository->findOneBy([]);
    }

    public
    function getSocialNetworks(): array
    {
        return $this->socialNetworkRepository->findAll();
    }

    public
    function getMenuLinks(): array
    {
        return [
            [
                'name' => 'О нас',
                'link' => 'app_about',
            ],
            [
                'name' => 'Услуги',
                'link' => 'app_service',
                'subLinks' => array_map(fn(Service $service) => [
                    'name' => $service->getTitle(),
                    'link' => "/service/{$service->getSlug()}",
                ], $this->serviceRepository->findByParentService() ?? []),
            ],
            [
                'name' => 'Контакты',
                'link' => 'app_contact',
            ],
        ];
    }
}