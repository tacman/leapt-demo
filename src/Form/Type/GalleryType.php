<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Gallery;
use Leapt\CoreBundle\Form\Type\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('localImageFile', ImageType::class, [
                'file_path' => 'localImage',
                'required' => false,
            ])
            ->add('s3ImageFile', ImageType::class, [
                'file_path' => 's3Image',
                'required' => false,
            ])
            ->add('s3AsyncImageFile', ImageType::class, [
                'file_path' => 's3AsyncImage',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Gallery::class);
    }
}
