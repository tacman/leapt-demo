<?php

declare(strict_types=1);

namespace App\Datalist\Type;

use App\Entity\Category;
use App\Entity\Enums\Status;
use App\Entity\News;
use Leapt\CoreBundle\Datalist\Action\Type\SimpleActionType;
use Leapt\CoreBundle\Datalist\DatalistBuilder;
use Leapt\CoreBundle\Datalist\Field\Type\BooleanFieldType;
use Leapt\CoreBundle\Datalist\Field\Type\DateTimeFieldType;
use Leapt\CoreBundle\Datalist\Field\Type\ImageFieldType;
use Leapt\CoreBundle\Datalist\Field\Type\LabelFieldType;
use Leapt\CoreBundle\Datalist\Field\Type\TextFieldType;
use Leapt\CoreBundle\Datalist\Filter\Type\EntityFilterType;
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
                'filters_on_top' => false,
            ])
            ->setRequired(['is_tiled', 'theme'])
            ->setAllowedTypes('is_tiled', ['bool'])
            ->setAllowedValues('theme', ['default', 'bootstrap3', 'bootstrap4', 'bootstrap5'])
        ;
    }

    public function buildDatalist(DatalistBuilder $builder, array $options): void
    {
        if ($options['is_tiled']) {
            $builder->addField('image', ImageFieldType::class);
        }

        $statusClasses = match ($options['theme']) {
            'default', 'bootstrap4', 'bootstrap5' => 'badge bg',
            'bootstrap3' => 'label label',
        };

        $builder
            ->addField('active', BooleanFieldType::class)
            ->addField('status', LabelFieldType::class, [
                'mappings' => [
                    Status::Pending->value => [
                        'label' => 'Pending',
                        'attr' => ['class' => $statusClasses . '-warning'],
                    ],
                    Status::Validated->value => [
                        'label' => 'Validated',
                        'attr' => ['class' => $statusClasses . '-success'],
                    ],
                ],
            ])
            ->addField('title', TextFieldType::class, [
                'label' => 'Title',
            ])
            ->addField('category', TextFieldType::class, [
                'label' => 'Category',
                'property_path' => 'category.name',
            ])
            ->addField('publicationDate', DateTimeFieldType::class, [
                'format' => 'd/m/Y',
            ])
            ->addFilter('title', SearchFilterType::class, [
                'search_fields' => ['n.title'],
            ])
            ->addFilter('category', EntityFilterType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'property_path' => 'n.category',
            ])
            ->addAction('view', SimpleActionType::class, [
                'route'  => 'app_news_view',
                'params' => ['slug' => 'slug'],
            ])
            ->addAction('update', SimpleActionType::class, [
                'route'  => 'app_news_update',
                'params' => ['id' => 'id'],
                'attr' => ['class' => 'btn btn-primary'],
            ])
        ;
    }
}
