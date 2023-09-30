<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('service/index.html.twig', [
            'services' => $serviceRepository->findByParentService(null),
        ]);
    }

    #[Route('/service/{slug}', name: 'app_service_show')]
    public function show(Service $service = null): Response
    {
        if ($service) {
            return $this->render('pages/service.html.twig', [
                'service' => $service,
            ]);
        }

        return $this->redirectToRoute('app_home');
    }
}
