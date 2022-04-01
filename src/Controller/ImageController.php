<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\Type\GalleryType;
use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(name: 'app_image_')]
final class ImageController extends AbstractController
{
    public function __construct(
        private GalleryRepository $galleryRepository,
    ) {
    }

    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('image/index.html.twig', [
            'galleries' => $this->galleryRepository->findAll(),
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $gallery = new Gallery();
        $form = $this->createForm(GalleryType::class, $gallery, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_image_create'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->galleryRepository->save($gallery);

            return $this->redirectToRoute('app_image_index');
        }

        return $this->renderForm('image/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Gallery $gallery): Response
    {
        $this->galleryRepository->delete($gallery);

        return $this->redirectToRoute('app_image_index');
    }
}
