<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/news', name: 'app_news_')]
final class NewsController extends AbstractController
{
    #[Route('/{slug}', name: 'view')]
    public function view(News $news): Response
    {
        return $this->render('news/view.html.twig', [
            'news' => $news,
        ]);
    }
}
