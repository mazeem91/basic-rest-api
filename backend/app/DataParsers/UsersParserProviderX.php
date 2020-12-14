<?php

namespace App\DataParsers;

use DateTime;

class UsersParserProviderX implements UsersParserInterface
{
    public const PROVIDER_JSON_FILE_URL = "https://bitbucket.org/!api/2.0/snippets/parenthq/Lrgexj/b6497026d572dadc1e9e14dc08a2e81e73f65040/files/DataProviderX.json";
    public const PROVIDER_NAME = "DataProviderX";

    /**
     * Get Provider file for parsing
     *
     * @param array $data
     * @return string
     */
    public function getDataProviderFile(): string
    {
        return self::PROVIDER_JSON_FILE_URL;
    }

    /**
     * Get Provider name
     *
     * @param array $data
     * @return string
     */
    public function getDataProviderName(): string
    {
        return self::PROVIDER_NAME;
    }

    /**
     * @inheritDoc
     */
    public function getUuid(array $data): string
    {
        return $data['parentIdentification'];
    }

    /**
     * @inheritDoc
     */
    public function getEmail(array $data): string
    {
        return $data['parentEmail'];
    }

    /**
     * @inheritDoc
     */
    public function getCurrency(array $data): string
    {
        return $data['Currency'];
    }

    /**
     * @inheritDoc
     */
    public function getStatus(array $data): string
    {
        $map = [
            1 => 'authorised',
            2 => 'decline',
            3 => 'refunded'
        ];
        return $map[$data['statusCode']];
    }

    /**
     * @inheritDoc
     */
    public function getBalance(array $data): int
    {
        return $data['parentAmount'];
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(array $data): DateTime
    {
        return new DateTime($data['registerationDate']);
    }
}