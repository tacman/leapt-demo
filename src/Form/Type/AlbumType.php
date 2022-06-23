<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('photos', CollectionType::class, [
                'label'         => 'Photos',
                'entry_type'    => PhotoType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false,
                'add_label'     => 'Add a photo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Album::class);
    }
}
