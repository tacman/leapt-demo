<?php

declare(strict_types=1);

namespace App\Controller;

use Leapt\CoreBundle\Paginator\ArrayPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paginator', name: 'app_paginator_')]
final class PaginatorController extends AbstractController
{
    private const ITEMS = [
        'C', 'C++', 'C#', 'Go', 'Java',
        'JavaScript', 'Kotlin', 'PHP', 'Python', 'R',
        'Ruby', 'Rust', 'Swift', 'TypeScript',
    ];

    #[Route('', name: 'index')]
    public function index(Request $request): Response
    {
        return $this->render('paginator/index.html.twig', [
            'paginator' => $this->getPaginator($request),
        ]);
    }

    #[Route('/bootstrap-3', name: 'bootstrap_3')]
    public function bootstrap3(Request $request): Response
    {
        return $this->render('paginator/bootstrap_3.html.twig', [
            'paginator' => $this->getPaginator($request),
        ]);
    }

    #[Route('/bootstrap-4', name: 'bootstrap_4')]
    public function bootstrap4(Request $request): Response
    {
        return $this->render('paginator/bootstrap_4.html.twig', [
            'paginator' => $this->getPaginator($request),
        ]);
    }

    #[Route('/bootstrap-5', name: 'bootstrap_5')]
    public function bootstrap5(Request $request): Response
    {
        return $this->render('paginator/bootstrap_5.html.twig', [
            'paginator' => $this->getPaginator($request),
        ]);
    }

    private function getPaginator(Request $request): ArrayPaginator
    {
        $paginator = new ArrayPaginator(self::ITEMS);
        $paginator->setLimitPerPage(5);
        $paginator->setPage($request->query->getInt('page', 1));

        return $paginator;
    }
}
