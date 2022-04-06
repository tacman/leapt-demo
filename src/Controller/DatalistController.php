<?php

declare(strict_types=1);

namespace App\Controller;

use App\Datalist\Type\NewsDatalistType;
use App\Repository\NewsRepository;
use Leapt\CoreBundle\Datalist\Datalist;
use Leapt\CoreBundle\Datalist\DatalistFactory;
use Leapt\CoreBundle\Datalist\Datasource\DoctrineORMDatasource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/datalist', name: 'app_datalist_')]
final class DatalistController extends AbstractController
{
    public function __construct(
        private DatalistFactory $datalistFactory,
        private NewsRepository $newsRepository,
    ) {
    }

    #[Route('', name: 'index')]
    public function index(Request $request): Response
    {
        return $this->render('datalist/index.html.twig', [
            'datalist' => $this->getDatalist($request),
        ]);
    }

    #[Route('/bootstrap-3', name: 'bootstrap_3')]
    public function bootstrap3(Request $request): Response
    {
        return $this->render('datalist/bootstrap_3.html.twig', [
            'datalist' => $this->getDatalist($request),
        ]);
    }

    #[Route('/bootstrap-4', name: 'bootstrap_4')]
    public function bootstrap4(Request $request): Response
    {
        return $this->render('datalist/bootstrap_4.html.twig', [
            'datalist' => $this->getDatalist($request),
        ]);
    }

    #[Route('/bootstrap-5', name: 'bootstrap_5')]
    public function bootstrap5(Request $request): Response
    {
        return $this->render('datalist/bootstrap_5.html.twig', [
            'datalist' => $this->getDatalist($request),
        ]);
    }

    private function getDatalist(Request $request): Datalist
    {
        $queryBuilder = $this->newsRepository->createQueryBuilder('n')
            ->orderBy('n.publicationDate', 'DESC');

        $datalist = $this->datalistFactory
            ->createBuilder(NewsDatalistType::class)
            ->getDatalist();

        $datalist->setRoute($request->attributes->get('_route'))
            ->setRouteParams($request->query->all());
        $datasource = new DoctrineORMDatasource($queryBuilder);
        $datalist->setDatasource($datasource);
        $datalist->bind($request);

        return $datalist;
    }
}
