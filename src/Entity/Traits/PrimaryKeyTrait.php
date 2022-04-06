<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait PrimaryKeyTrait
{
    #[ORM\Column, ORM\Id, ORM\GeneratedValue]
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
