<?php

namespace App\Controller;

use App\Repository\BranchRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository, BranchRepository $branchRepository): Response
    {
        return $this->render('pages/contacts.html.twig', [
            'contact' => $contactRepository->findOneBy([]),
            'branches' => $branchRepository->findBy([], [])
        ]);
    }
}
