<?php

declare(strict_types=1);

namespace App\Datalist\Type;

use App\Entity\Album;
use Leapt\CoreBundle\Datalist\Action\Type\SimpleActionType;
use Leapt\CoreBundle\Datalist\DatalistBuilder;
use Leapt\CoreBundle\Datalist\Field\Type\TextFieldType;
use Leapt\CoreBundle\Datalist\Type\DatalistType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AlbumDatalistType extends DatalistType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults([
                'limit_per_page' => 10,
                'data_class'     => Album::class,
            ])
        ;
    }

    public function buildDatalist(DatalistBuilder $builder, array $options): void
    {
        $builder
            ->addField('name', TextFieldType::class, [
                'label' => 'Name',
            ])
            ->addField('photos', TextFieldType::class, [
                'label'    => 'Photos',
                'callback' => fn (Album $album): int => $album->getPhotos()->count(),
            ])
            ->addAction('update', SimpleActionType::class, [
                'route'  => 'app_album_update',
                'params' => ['id' => 'id'],
                'attr'   => ['class' => 'btn-secondary'],
            ])
            ->addAction('delete', SimpleActionType::class, [
                'route'  => 'app_album_delete',
                'params' => ['id' => 'id'],
                'attr'   => ['class' => 'btn-danger'],
            ])
        ;
    }
}
