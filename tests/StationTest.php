<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\Stations\StationFactory;
use App\Factory\User\UserFactory;
use Zenstruck\Foundry\Test\Factories;

class StationsTest extends ApiTestCase
{
    use Factories;

    /** @test */
    public function GetStationsTest(): void
    {
        UserFactory::createMany(5);

        StationFactory::createOne(['stationsBoss' => UserFactory::random()]);
    }
}