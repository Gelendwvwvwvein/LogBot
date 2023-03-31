<?php

namespace App\Factory\Requests;

use App\Entity\Requests\Request;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Request>
 *
 * @method        Request|Proxy create(array|callable $attributes = [])
 * @method static Request|Proxy createOne(array $attributes = [])
 * @method static Request|Proxy find(object|array|mixed $criteria)
 * @method static Request|Proxy findOrCreate(array $attributes)
 * @method static Request|Proxy first(string $sortedField = 'id')
 * @method static Request|Proxy last(string $sortedField = 'id')
 * @method static Request|Proxy random(array $attributes = [])
 * @method static Request|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Request[]|Proxy[] all()
 * @method static Request[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Request[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Request[]|Proxy[] findBy(array $attributes)
 * @method static Request[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Request[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class RequestFactory extends ModelFactory
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
            'createdAt' => self::faker()->dateTime(),
            'users_dest' => RequestFactory::new(),
            'users_sender' => RequestFactory::new(),
            'whereTo' => RequestFactory::new(),
            'whitherTo' => RequestFactory::new(),
            'robotId' => RequestFactory::new()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Request $request): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Request::class;
    }
}
