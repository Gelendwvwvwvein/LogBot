<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use App\Factory\User\UserFactory;

class UserTest extends ApiTestCase
{
    use Factories;

    /** @test */
    public function GetUsersTest(): void
    {
        UserFactory::createMany(2);

        static::createClient()->request('GET', '/users');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
    }
}