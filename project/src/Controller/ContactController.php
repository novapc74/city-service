<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Repository\SocialNetworkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository, SocialNetworkRepository $networkRepository): Response
    {
        return $this->render('pages/contacts.html.twig', [
            'contact' => $contactRepository->findOneBy([]),
            'socialNetworks' => $networkRepository->findAll() ?? [],
        ]);
    }
}
