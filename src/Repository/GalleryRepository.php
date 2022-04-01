<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Gallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class GalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gallery::class);
    }

    public function save(Gallery $gallery): void
    {
        $this->getEntityManager()->persist($gallery);
        $this->getEntityManager()->flush();
    }

    public function delete(Gallery $gallery): void
    {
        $this->getEntityManager()->remove($gallery);
        $this->getEntityManager()->flush();
    }
}
