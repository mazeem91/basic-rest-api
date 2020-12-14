<?php

namespace App\DataParsers;

use DateTime;

interface UsersParserInterface
{
    /**
     * Get Provider name
     *
     * @param array $data
     * @return string
     */
    public function getDataProviderName(): string;

    /**
     * Parse Uuid 
     *
     * @param array $data
     * @return string
     */
    public function getUuid(array $data): string;

    /**
     * Parse Email
     *
     * @param array $data
     * @return string
     */
    public function getEmail(array $data): string;

    /**
     * Parse Currency
     *
     * @param array $data
     * @return string
     */
    public function getCurrency(array $data): string;

    /**
     * Parse Status
     *
     * @param array $data
     * @return string
     */
    public function getStatus(array $data): string;

    /**
     * Parse Balance
     *
     * @param array $data
     * @return integer
     */
    public function getBalance(array $data): float;

    /**
     * Parse CreatedAt
     *
     * @param array $data
     * @return DateTimes
     */
    public function getCreatedAt(array $data): DateTime;
}