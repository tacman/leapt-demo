<?php

declare(strict_types=1);

namespace App\Datalist\Type;

use App\Entity\News;
use Leapt\CoreBundle\Datalist\Action\Type\SimpleActionType;
use Leapt\CoreBundle\Datalist\DatalistBuilder;
use Leapt\CoreBundle\Datalist\Field\Type\DateTimeFieldType;
use Leapt\CoreBundle\Datalist\Field\Type\TextFieldType;
use Leapt\CoreBundle\Datalist\Filter\Type\SearchFilterType;
use Leapt\CoreBundle\Datalist\Type\DatalistType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class NewsDatalistType extends DatalistType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults([
                'limit_per_page' => 10,
                'data_class'     => News::class,
            ])
        ;
    }

    public function buildDatalist(DatalistBuilder $builder, array $options): void
    {
        $builder
            ->addField('title', TextFieldType::class, [
                'label' => 'Title',
            ])
            ->addField('publicationDate', DateTimeFieldType::class, [
                //'label'  => 'news.publication_date',
                'format' => 'd/m/Y',
            ])
            ->addFilter('title', SearchFilterType::class, [
                //'label'         => 'news.title',
                'search_fields' => ['n.title'],
            ])
            ->addAction('view', SimpleActionType::class, [
                'route'  => 'app_news_view',
                //'label'  => 'content.index.view',
                'params' => ['slug' => 'slug'],
            ])
        ;
    }
}
