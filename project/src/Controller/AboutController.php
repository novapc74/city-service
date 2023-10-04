<?php

namespace App\Controller;

use App\Repository\AdvantageRepository;
use App\Repository\CertificateRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(ReviewRepository      $reviewRepository,
                          AdvantageRepository   $advantageRepository,
                          CertificateRepository $certificateRepository): Response
    {
        return $this->render('pages/about.html.twig', [
            'reviews' => $reviewRepository->findBy([], []),
            'advantages' => $advantageRepository->findBy([], []),
            'certificates' => $certificateRepository->findBy([], []),
        ]);
    }
}
