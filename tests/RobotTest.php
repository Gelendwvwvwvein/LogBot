<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use App\Factory\User\UserFactory;
use App\Factory\Robots\RobotFactory;

class RobotTest extends ApiTestCase
{
    use Factories;

    /** @test */
    public function GetRobotsTest(): void
    {
        RobotFactory::createMany(2, ['robotBossId' => UserFactory::random()]);

        static::createClient()->request('GET', '/robots');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
    }
}