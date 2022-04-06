<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\PrimaryKeyTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Leapt\CoreBundle\Doctrine\Mapping as LeaptCore;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Gallery
{
    use PrimaryKeyTrait;

    #[ORM\Column(type: Types::STRING)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $title;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $localImage = null;

    #[LeaptCore\File(path: 'uploads/local-image', mappedBy: 'localImage', flysystemConfig: 'local')]
    private ?UploadedFile $localImageFile = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $s3Image = null;

    #[LeaptCore\File(path: 'uploads/s3-image', mappedBy: 's3Image', flysystemConfig: 's3')]
    private ?UploadedFile $s3ImageFile = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $s3AsyncImage = null;

    #[LeaptCore\File(path: 'uploads/s3-async-image', mappedBy: 's3AsyncImage', flysystemConfig: 's3async')]
    private ?UploadedFile $s3AsyncImageFile = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getLocalImage(): ?string
    {
        return $this->localImage;
    }

    public function setLocalImage(?string $localImage): void
    {
        $this->localImage = $localImage;
    }

    public function getLocalImageFile(): ?UploadedFile
    {
        return $this->localImageFile;
    }

    public function setLocalImageFile(?UploadedFile $localImageFile): void
    {
        $this->localImageFile = $localImageFile;
    }

    public function getS3Image(): ?string
    {
        return $this->s3Image;
    }

    public function setS3Image(?string $s3Image): void
    {
        $this->s3Image = $s3Image;
    }

    public function getS3ImageFile(): ?UploadedFile
    {
        return $this->s3ImageFile;
    }

    public function setS3ImageFile(?UploadedFile $s3ImageFile): void
    {
        $this->s3ImageFile = $s3ImageFile;
    }

    public function getS3AsyncImage(): ?string
    {
        return $this->s3AsyncImage;
    }

    public function setS3AsyncImage(?string $s3AsyncImage): void
    {
        $this->s3AsyncImage = $s3AsyncImage;
    }

    public function getS3AsyncImageFile(): ?UploadedFile
    {
        return $this->s3AsyncImageFile;
    }

    public function setS3AsyncImageFile(?UploadedFile $s3AsyncImageFile): void
    {
        $this->s3AsyncImageFile = $s3AsyncImageFile;
    }
}
