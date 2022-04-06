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
class Media
{
    use PrimaryKeyTrait;

    #[LeaptCore\File(path: 'media/files', mappedBy: 'filePath', flysystemConfig: 'local')]
    private ?UploadedFile $file = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $filePath = null;

    #[LeaptCore\File(path: 'media/images', mappedBy: 'imagePath', flysystemConfig: 'local')]
    #[Assert\Image]
    private ?UploadedFile $image = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $imagePath = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $soundcloud = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $youtube = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $vimeo = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $dailymotion = null;

    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    public function setFile(?UploadedFile $file): void
    {
        $this->file = $file;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function setImage(?UploadedFile $image): void
    {
        $this->image = $image;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getSoundcloud(): ?string
    {
        return $this->soundcloud;
    }

    public function setSoundcloud(?string $soundcloud): void
    {
        $this->soundcloud = $soundcloud;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): void
    {
        $this->youtube = $youtube;
    }

    public function getVimeo(): ?string
    {
        return $this->vimeo;
    }

    public function setVimeo(?string $vimeo): void
    {
        $this->vimeo = $vimeo;
    }

    public function getDailymotion(): ?string
    {
        return $this->dailymotion;
    }

    public function setDailymotion(?string $dailymotion): void
    {
        $this->dailymotion = $dailymotion;
    }
}
