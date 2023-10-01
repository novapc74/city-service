<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service/{slug}', name: 'app_service_show')]
    public function show(Service $service = null): Response
    {
        if (null === $service) {
            return $this->redirectToRoute('app_home');
        }

        $page = $service->isIsActive() ? 'pages/service.html.twig' : 'pages/in_developing.html.twig';

        return $this->render($page, compact('service'));
    }
}
