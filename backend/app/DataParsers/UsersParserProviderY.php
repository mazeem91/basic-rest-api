<?php

namespace App\DataParsers;

use DateTime;

class UsersParserProviderY implements UsersParserInterface
{
    public const PROVIDER_NAME = "DataProviderY";

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
        return $data['id'];
    }

    /**
     * @inheritDoc
     */
    public function getEmail(array $data): string
    {
        return $data['email'];
    }

    /**
     * @inheritDoc
     */
    public function getCurrency(array $data): string
    {
        return $data['currency'];
    }

    /**
     * @inheritDoc
     */
    public function getStatus(array $data): string
    {
        $map = [
            100 => 'authorised',
            200 => 'decline',
            300 => 'refunded'
        ];
        return $map[$data['status']];
    }

    /**
     * @inheritDoc
     */
    public function getBalance(array $data): float
    {
        return $data['balance'];
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(array $data): DateTime
    {
        return DateTime::createFromFormat('d/m/Y', $data['created_at']);
    }
}