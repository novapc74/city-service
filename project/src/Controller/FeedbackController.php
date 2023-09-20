<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Message\SendEmail;
use App\Form\PopupFeedbackFormType;
use App\Form\FooterFeedbackFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class FeedbackController extends AbstractController
{
	#[Route('/feedback/popup', name: 'app_feedback_footer', methods: ['GET', 'POST'])]
	public function resolveFooterForm(Request             $request,
	                                  ManagerRegistry     $managerRegistry,
	                                  MessageBusInterface $bus): Response
	{
		return $this->resolveForm($request, $managerRegistry, $bus, PopupFeedbackFormType::class);
	}

	#[Route('/feedback/footer', name: 'app_feedback_popup', methods: ['GET', 'POST'])]
	public function resolvePopupForm(Request             $request,
	                                 ManagerRegistry     $managerRegistry,
	                                 MessageBusInterface $bus): Response
	{
		return $this->resolveForm($request, $managerRegistry, $bus, FooterFeedbackFormType::class);
	}

	private function resolveForm($request, $managerRegistry, $bus, $formType): Response
	{
//		if (!$request->isXmlHttpRequest()) {
//			return $this->redirect('/');
//		}

		$feedBack = new Feedback();

		$form = $this->createForm($formType, $feedBack);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$feedBack = $form->getData();

			$em = $managerRegistry->getManager();
			$em->persist($feedBack);
			$em->flush();

			$bus->dispatch(new SendEmail($feedBack));

			return $this->json(['success' => true], 201);
		}

		return $this->render("feedback/form.html.twig", [
			'form' => $form->createView()
		]);
	}
}

