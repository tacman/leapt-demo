<?php

declare(strict_types=1);

namespace App\Feed;

use App\Entity\News;
use App\Repository\NewsRepository;
use Leapt\CoreBundle\Feed\FeedInterface;
use Leapt\CoreBundle\Feed\FeedItem;
use Symfony\Component\Routing\RouterInterface;

final class NewsFeed implements FeedInterface
{
    public function __construct(
        private NewsRepository $newsRepository,
        private RouterInterface $router,
    ) {
    }

    public function getId(): string
    {
        return $this->router->generate('app_default_index', [], RouterInterface::ABSOLUTE_URL);
    }

    public function getLink(): string
    {
        return $this->router->generate('app_default_index', [], RouterInterface::ABSOLUTE_URL);
    }

    public function getTitle(): string
    {
        return 'ACME website';
    }

    public function getDescription(): string
    {
        return 'ACME Description';
    }

    public function getUpdatedAt(): \DateTime
    {
        $items = $this->getItems();

        return isset($items[0]) ? $items[0]->getPublicationDate() : new \DateTime();
    }

    public function getItems(): iterable
    {
        return $this->newsRepository->findLatest(20);
    }

    /**
     * @param News $item
     */
    public function buildItem($item): FeedItem
    {
        $uri = $this->router->generate('app_news_view', [
            'slug' => $item->getSlug(),
        ], RouterInterface::ABSOLUTE_URL);

        $feedItem = new FeedItem();
        $feedItem->id = $uri;
        $feedItem->title = $item->getTitle();
        $feedItem->description = $item->getContent();
        $feedItem->createdAt = $item->getPublicationDate();
        $feedItem->updatedAt = $item->getPublicationDate();
        $feedItem->link = $uri;
        $feedItem->author = ['name' => $item->getAuthorName(), 'email' => $item->getAuthorEmail()];

        return $feedItem;
    }
}
