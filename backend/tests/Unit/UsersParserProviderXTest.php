<?php

namespace Tests\Unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\DataParsers\DataParserFactory;
use App\DataParsers\UsersParserProviderX;

class UsersParserProviderXTest extends TestCase
{
    private function getUserData()
    {
        $jsonString = '{
            "parentAmount":280,
            "Currency":"EUR",
            "parentEmail":"parent1@parent.eu",
            "statusCode":1,
            "registerationDate": "2018-11-30",
            "parentIdentification": "d3d29d70-1d25-11e3-8591-034165a3a613"
        }';

        return json_decode($jsonString, true);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testParsing()
    {
        $userData = $this->getUserData();
        $usersParserProviderX = DataParserFactory::create(UsersParserProviderX::PROVIDER_NAME);

        $this->assertEquals("d3d29d70-1d25-11e3-8591-034165a3a613", $usersParserProviderX->getUuid($userData));
        $this->assertEquals("EUR", $usersParserProviderX->getCurrency($userData));
        $this->assertEquals("parent1@parent.eu", $usersParserProviderX->getEmail($userData));
        $this->assertEquals("authorised", $usersParserProviderX->getStatus($userData));
        $this->assertEquals(280, $usersParserProviderX->getBalance($userData));
        $this->assertEquals(
            (new DateTime('2018-11-30'))->getTimestamp(),
            $usersParserProviderX->getCreatedAt($userData)->getTimestamp()
        );
    }
}
