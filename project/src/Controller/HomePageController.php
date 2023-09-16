<?php

namespace App\Controller;

use App\Repository\AdvantageRepository;
use App\Repository\BranchRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BranchRepository    $branchRepository,
                          ReviewRepository    $reviewRepository,
                          AdvantageRepository $advantageRepository): Response
    {
        return $this->render('home_page/index.html.twig', [
            'branches' => $branchRepository->findBy([], [], 6),
            'reviews' => $reviewRepository->findBy([], [], 6),
            'advantages' => $advantageRepository->findBy([], [], 3),
        ]);
    }
}
