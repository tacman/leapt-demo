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
    #[Route('', name: 'index')]
    public function index(Request $request): Response
    {
        $items = [
            'C', 'C++', 'C#', 'Go', 'Java',
            'JavaScript', 'Kotlin', 'PHP', 'Python', 'R',
            'Ruby', 'Rust', 'Swift', 'TypeScript',
        ];
        $paginator = new ArrayPaginator($items);
        $paginator->setLimitPerPage(5);
        $paginator->setPage($request->query->getInt('page', 1));

        return $this->render('paginator/index.html.twig', [
            'paginator' => $paginator,
        ]);
    }
}
