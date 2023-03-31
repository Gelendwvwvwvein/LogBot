<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use App\Factory\Stations\StationFactory;
use App\Factory\User\UserFactory;

class StationTest extends ApiTestCase
{
    use Factories;

    /** @test */
    public function GetStationsTest(): void
    {
        StationFactory::createMany(2, ['stationsBoss' => UserFactory::random()]);

        static::createClient()->request('GET', '/stations');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
    }
}