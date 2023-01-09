<?php

declare(strict_types=1);

namespace App\Controller;

use App\Datalist\Type\AlbumDatalistType;
use App\Entity\Album;
use App\Form\Type\AlbumType;
use App\Repository\AlbumRepository;
use Leapt\CoreBundle\Datalist\DatalistFactory;
use Leapt\CoreBundle\Datalist\Datasource\DoctrineORMDatasource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/album', name: 'app_album_')]
final class AlbumController extends AbstractController
{
    public function __construct(
        private readonly AlbumRepository $albumRepository,
        private readonly DatalistFactory $datalistFactory,
    ) {
    }

    #[Route('', name: 'index')]
    public function index(Request $request): Response
    {
        $datalist = $this->datalistFactory
            ->createBuilder(AlbumDatalistType::class)
            ->getDatalist();
        $datalist->setRoute($request->attributes->get('_route'))
            ->setRouteParams($request->query->all());
        $datasource = new DoctrineORMDatasource($this->albumRepository->getListQueryBuilder());
        $datalist->setDatasource($datasource);
        $datalist->bind($request);

        return $this->render('album/index.html.twig', [
            'datalist' => $datalist,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_album_create'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->albumRepository->save($album);

            return $this->redirectToRoute('app_album_index');
        }

        return $this->render('album/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(Request $request, Album $album): Response
    {
        $form = $this->createForm(AlbumType::class, $album, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_album_update', ['id' => $album->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->albumRepository->save($album);

            return $this->redirectToRoute('app_album_index');
        }

        return $this->render('album/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Album $album): Response
    {
        $this->albumRepository->delete($album);

        return $this->redirectToRoute('app_album_index');
    }
}
