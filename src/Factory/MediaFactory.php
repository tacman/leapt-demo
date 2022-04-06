<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Media;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Media>
 *
 * @method static Media|Proxy createOne(array $attributes = [])
 * @method static Media[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Media|Proxy find(object|array|mixed $criteria)
 * @method static Media|Proxy findOrCreate(array $attributes)
 * @method static Media|Proxy first(string $sortedField = 'id')
 * @method static Media|Proxy last(string $sortedField = 'id')
 * @method static Media|Proxy random(array $attributes = [])
 * @method static Media|Proxy randomOrCreate(array $attributes = [])
 * @method static Media[]|Proxy[] all()
 * @method static Media[]|Proxy[] findBy(array $attributes)
 * @method static Media[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Media[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Media|Proxy create(array|callable $attributes = [])
 */
final class MediaFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [];
    }

    protected static function getClass(): string
    {
        return Media::class;
    }
}
