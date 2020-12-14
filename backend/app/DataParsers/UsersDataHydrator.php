<?php

namespace App\DataParsers;

use Closure;
use JsonMachine\JsonMachine;

class UsersDataHydrator
{
    protected $usersParser;
    protected $jsonFileUrl;
    protected $resouresArrayPointer;

    public function __construct(
        UsersParserInterface $usersParser,
        string $jsonFileUrl,
        string $resouresArrayPointer = ''
    ) {
        $this->usersParser = $usersParser;
        $this->jsonFileUrl = $jsonFileUrl;
        $this->resouresArrayPointer = $resouresArrayPointer;
    }

    /**
     * Applys closure on each user array
     *
     * @param Closure $closure
     * @return void
     */
    public function apply(Closure $closure)
    {
        $usersData = JsonMachine::fromFile($this->jsonFileUrl, $this->resouresArrayPointer);
        foreach ($usersData as $userData) {
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
