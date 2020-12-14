<?php

namespace App\DataParsers;

class DataParserFactory
{
    public const DATA_PARSER_MAP = [
        UsersParserProviderX::PROVIDER_NAME => UsersParserProviderX::class,
        UsersParserProviderY::PROVIDER_NAME => UsersParserProviderY::class,
    ];

    public static function create($parserName)
    {
        if (array_key_exists($parserName, self::DATA_PARSER_MAP)) {
            $class = self::DATA_PARSER_MAP[$parserName];
            return new $class;
        }
    }
}
