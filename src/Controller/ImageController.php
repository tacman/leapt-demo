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

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('image/index.html.twig', [
            'galleries' => $this->galleryRepository->findAll(),
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
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

    #[Route('/update/{id}', name: 'update', methods: ['GET', 'POST'])]
    public function update(Request $request, Gallery $gallery): Response
    {
        $form = $this->createForm(GalleryType::class, $gallery, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_image_update', ['id' => $gallery->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->galleryRepository->save($gallery);

            return $this->redirectToRoute('app_image_index');
        }

        return $this->renderForm('image/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Gallery $gallery): Response
    {
        $this->galleryRepository->delete($gallery);

        return $this->redirectToRoute('app_image_index');
    }
}
