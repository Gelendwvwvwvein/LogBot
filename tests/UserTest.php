<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\Stations\StationFactory;
use App\Factory\User\UserFactory;
use Zenstruck\Foundry\Test\Factories;

class UserTest extends ApiTestCase
{
    use Factories;

    /** @test */
    public function GetUsersTest(): void
    {

        UserFactory::createOne(['stationBossId' => StationFactory::new()->many(5)]);

        //static::createClient()->request('GET', '/users');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
    }
}