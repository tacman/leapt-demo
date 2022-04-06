<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\News;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<News>
 *
 * @method static News|Proxy createOne(array $attributes = [])
 * @method static News[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static News|Proxy find(object|array|mixed $criteria)
 * @method static News|Proxy findOrCreate(array $attributes)
 * @method static News|Proxy first(string $sortedField = 'id')
 * @method static News|Proxy last(string $sortedField = 'id')
 * @method static News|Proxy random(array $attributes = [])
 * @method static News|Proxy randomOrCreate(array $attributes = [])
 * @method static News[]|Proxy[] all()
 * @method static News[]|Proxy[] findBy(array $attributes)
 * @method static News[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static News[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method News|Proxy create(array|callable $attributes = [])
 */
final class NewsFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->word(),
            'slug' => self::faker()->slug(),
            'content' => self::faker()->text(),
            'publicationDate' => self::faker()->datetime(),
            'authorName' => self::faker()->userName(),
            'authorEmail' => self::faker()->email(),
            'category' => CategoryFactory::random(),
            'image' => self::faker()->optional(.7)->passthrough('static-files/' . self::faker()->numberBetween(1, 10) . '.jpg'),
        ];
    }

    protected static function getClass(): string
    {
        return News::class;
    }
}
