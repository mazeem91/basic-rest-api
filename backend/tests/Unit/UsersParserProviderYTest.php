<?php

namespace Tests\Unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\DataParsers\DataParserFactory;
use App\DataParsers\UsersParserProviderY;

class UsersParserProviderYTest extends TestCase
{
    private function getUserData()
    {
        $jsonString = '{
            "balance": 354.5,
            "currency": "AED",
            "email": "parent100@parent.eu",
            "status": 100,
            "created_at": "22/12/2018",
            "id": "3fc2-a8d1"
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
        $usersParserProviderX = DataParserFactory::create(UsersParserProviderY::PROVIDER_NAME);

        $this->assertEquals("3fc2-a8d1", $usersParserProviderX->getUuid($userData));
        $this->assertEquals("AED", $usersParserProviderX->getCurrency($userData));
        $this->assertEquals("parent100@parent.eu", $usersParserProviderX->getEmail($userData));
        $this->assertEquals("authorised", $usersParserProviderX->getStatus($userData));
        $this->assertEquals(354.5, $usersParserProviderX->getBalance($userData));
        $this->assertEquals(
            (DateTime::createFromFormat('d/m/Y', '22/12/2018'))->getTimestamp(),
            $usersParserProviderX->getCreatedAt($userData)->getTimestamp()
        );
    }
}
