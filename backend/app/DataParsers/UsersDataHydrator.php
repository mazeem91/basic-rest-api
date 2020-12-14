<?php

namespace App\DataParsers;

use Closure;
use IteratorAggregate;

class UsersDataHydrator
{
    protected $usersParser;
    protected $usersData;

    public function __construct(
        UsersParserInterface $usersParser,
        IteratorAggregate $usersData
    ) {
        $this->usersParser = $usersParser;
        $this->usersData = $usersData;
    }

    /**
     * Applys closure on each user array
     *
     * @param Closure $closure
     * @return void
     */
    public function apply(Closure $closure)
    {
        foreach ($this->usersData as $userData) {
            $user = [];
            $user['id'] = $this->usersParser->getUuid($userData);
            $user['email'] = $this->usersParser->getEmail($userData);
            $user['currency'] = $this->usersParser->getCurrency($userData);
            $user['status'] = $this->usersParser->getStatus($userData);
            $user['balance'] = $this->usersParser->getBalance($userData);
            $user['created_at'] = $this->usersParser->getCreatedAt($userData);
            $user['provider'] = $this->usersParser->getDataProviderName($userData);
            $closure($user);
        }
    }
}
