<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use App\Factory\User\UserFactory;
use App\Factory\Requests\RequestFactory;
use App\Factory\Robots\RobotFactory;
use App\Factory\Stations\StationFactory;

class RequestTest extends ApiTestCase
{
    use Factories;

    /** @test */
    public function GetRequestsTest(): void
    {
        RequestFactory::createOne(
            ['users_dest' => UserFactory::random()], 
            ['users_sender' => UserFactory::random()],
            ['whereTo' => StationFactory::random()],
            ['whitherTo' => StationFactory::random()],
            ['robotId' => RobotFactory::random()]

    );
        //RequestFactory::createOne(['users_sender' => UserFactory::random()]);
        //RequestFactory::createOne(['whereTo' => StationFactory::random()]);
        //RequestFactory::createOne(['whitherTo' => StationFactory::random()]);
        //RequestFactory::createOne(['robotId' => RobotFactory::random()])


        static::createClient()->request('GET', '/requests');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
    }
}