<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\DataParsers\UsersDataHydrator;
use App\DataParsers\UsersParserInterface;
use Illuminate\Support\Collection;

class UsersDataHydratorTest extends TestCase
{
    protected $usersParserMock;
    protected $usersDataHydrator;

    public function setUp(): void
    {
        $this->usersParserMock = $this->createMock(UsersParserInterface::class);
        $this->usersDataHydrator = new UsersDataHydrator($this->usersParserMock, new Collection([[]]));
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserArrayKeysExists()
    {
        $this->usersDataHydrator->apply(function ($user) {
            $this->assertArrayHasKey('id', $user);
            $this->assertArrayHasKey('email', $user);
            $this->assertArrayHasKey('currency', $user);
            $this->assertArrayHasKey('status', $user);
            $this->assertArrayHasKey('balance', $user);
            $this->assertArrayHasKey('created_at', $user);
            $this->assertArrayHasKey('provider', $user);
        });
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCallingParserMethods()
    {
        $this->usersParserMock->expects($this->once())->method('getUuid');
        $this->usersParserMock->expects($this->once())->method('getEmail');
        $this->usersParserMock->expects($this->once())->method('getCurrency');
        $this->usersParserMock->expects($this->once())->method('getStatus');
        $this->usersParserMock->expects($this->once())->method('getBalance');
        $this->usersParserMock->expects($this->once())->method('getCreatedAt');
        $this->usersParserMock->expects($this->once())->method('getDataProviderName');

        $this->usersDataHydrator->apply(function ($user) {
        });
    }
}
