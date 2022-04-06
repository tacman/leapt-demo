<?php

declare(strict_types=1);

namespace App\Sitemap;

use Leapt\CoreBundle\Sitemap\AbstractSitemap;
use Symfony\Component\Routing\RouterInterface;

final class Sitemap extends AbstractSitemap
{
    public function build(RouterInterface $router): void
    {
        $this->addUrl($router->generate('app_default_index', [], RouterInterface::ABSOLUTE_URL));
        $this->addUrl($router->generate('app_gallery_index', [], RouterInterface::ABSOLUTE_URL));
        $this->addUrl($router->generate('app_form_type_index', [], RouterInterface::ABSOLUTE_URL));
        $this->addUrl($router->generate('app_paginator_index', [], RouterInterface::ABSOLUTE_URL));
    }
}
