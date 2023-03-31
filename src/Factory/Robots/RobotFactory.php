<?php

namespace App\Factory\Robots;

use App\Entity\Robots\Robot;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Robot>
 *
 * @method        Robot|Proxy create(array|callable $attributes = [])
 * @method static Robot|Proxy createOne(array $attributes = [])
 * @method static Robot|Proxy find(object|array|mixed $criteria)
 * @method static Robot|Proxy findOrCreate(array $attributes)
 * @method static Robot|Proxy first(string $sortedField = 'id')
 * @method static Robot|Proxy last(string $sortedField = 'id')
 * @method static Robot|Proxy random(array $attributes = [])
 * @method static Robot|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Robot[]|Proxy[] all()
 * @method static Robot[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Robot[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Robot[]|Proxy[] findBy(array $attributes)
 * @method static Robot[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Robot[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class RobotFactory extends ModelFactory
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
            'charge' => self::faker()->numberBetween(0, 100),
            'enabled' => self::faker()->numberBetween(0, 1),
            'location' => self::faker()->word(),
            'robotBossId' => RobotFactory::new()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Robot $robot): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Robot::class;
    }
}
