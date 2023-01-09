<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\MediaType;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form-types', name: 'app_form_type_')]
final class FormTypeController extends AbstractController
{
    public function __construct(private MediaRepository $mediaRepository)
    {
    }

    #[Route('', name: 'index')]
    public function index(Request $request): Response
    {
        return $this->createAndHandleForm($request, 'index');
    }

    #[Route('/bootstrap-3', name: 'bootstrap_3')]
    public function bootstrap3(Request $request): Response
    {
        return $this->createAndHandleForm($request, 'bootstrap_3');
    }

    #[Route('/bootstrap-4', name: 'bootstrap_4')]
    public function bootstrap4(Request $request): Response
    {
        return $this->createAndHandleForm($request, 'bootstrap_4');
    }

    #[Route('/bootstrap-5', name: 'bootstrap_5')]
    public function bootstrap5(Request $request): Response
    {
        return $this->createAndHandleForm($request, 'bootstrap_5');
    }

    private function createAndHandleForm(Request $request, string $action): Response
    {
        $route = 'app_form_type_' . $action;
        $media = $this->mediaRepository->findExistingOrCreateOne();
        $form = $this->createForm(MediaType::class, $media, [
            'method' => 'POST',
            'action' => $this->generateUrl($route),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->mediaRepository->save($media);

            return $this->redirectToRoute($route);
        }

        return $this->render('form_type/' . $action . '.html.twig', [
            'form' => $form,
        ]);
    }
}
