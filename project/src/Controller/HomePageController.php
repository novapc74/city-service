<?php

namespace App\Controller;

use App\Repository\AdvantageRepository;
use App\Repository\BranchRepository;
use App\Repository\CertificateRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BranchRepository      $branchRepository,
                          ReviewRepository      $reviewRepository,
                          AdvantageRepository   $advantageRepository,
                          CertificateRepository $certificateRepository): Response
    {
        return $this->render('pages/home.html.twig', [
            'branches' => $branchRepository->findBy([], []),
            'reviews' => $reviewRepository->findBy([], []),
            'advantages' => $advantageRepository->findBy([], []),
            'certificates' => $certificateRepository->findBy([], []),
            'isHome' => true,
        ]);
    }
}
