<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Media;
use Leapt\CoreBundle\Form\Type\FileType;
use Leapt\CoreBundle\Form\Type\ImageType;
use Leapt\CoreBundle\Form\Type\SoundType;
use Leapt\CoreBundle\Form\Type\VideoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'file_path' => 'filePath',
                'required' => false,
            ])
            ->add('image', ImageType::class, [
                'file_path' => 'imagePath',
                'required' => false,
            ])
            ->add('soundcloud', SoundType::class, [
                'provider' => 'soundcloud',
                'required' => false,
            ])
            ->add('youtube', VideoType::class, [
                'provider' => 'youtube',
                'required' => false,
            ])
            ->add('vimeo', VideoType::class, [
                'provider' => 'vimeo',
                'required' => false,
            ])
            ->add('dailymotion', VideoType::class, [
                'provider' => 'dailymotion',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Media::class);
    }
}
