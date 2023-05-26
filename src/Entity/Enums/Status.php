<?php

declare(strict_types=1);

namespace App\Entity\Enums;

enum Status: string
{
    case Pending = 'pending';
    case Validated = 'validated';
}
