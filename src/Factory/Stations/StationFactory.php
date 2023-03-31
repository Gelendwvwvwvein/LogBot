<?php

namespace App\Factory\Stations;

use App\Entity\Stations\Station;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use App\Entity\User\User;

/**
 * @extends ModelFactory<Station>
 *
 * @method        Station|Proxy create(array|callable $attributes = [])
 * @method static Station|Proxy createOne(array $attributes = [])
 * @method static Station|Proxy find(object|array|mixed $criteria)
 * @method static Station|Proxy findOrCreate(array $attributes)
 * @method static Station|Proxy first(string $sortedField = 'id')
 * @method static Station|Proxy last(string $sortedField = 'id')
 * @method static Station|Proxy random(array $attributes = [])
 * @method static Station|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Station[]|Proxy[] all()
 * @method static Station[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Station[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Station[]|Proxy[] findBy(array $attributes)
 * @method static Station[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Station[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class StationFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->word(),
            'stationsBoss' => StationFactory::new()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Station $station): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Station::class;
    }
}
