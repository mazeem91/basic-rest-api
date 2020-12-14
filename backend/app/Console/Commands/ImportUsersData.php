<?php

namespace App\Console\Commands;

use App\Models\User;
use JsonMachine\JsonMachine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\DataParsers\DataParserFactory;
use App\DataParsers\UsersParserProviderX;

class ImportUsersData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-users-data:db-store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users data from data providers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $parser = DataParserFactory::create(UsersParserProviderX::PROVIDER_NAME);
        $usersJson = JsonMachine::fromFile($parser->getDataProviderFile());
        $usersData = $this->getUsers($usersJson);

        $count = 0;
        foreach ($usersData as $userData) {
            try {
                User::insert($this->parseUser($userData, $parser));
            } catch (\Throwable $th) {
                Log::error($th);
            }
            echo 'Progress: ' . ++$count . " User/s processed \n";
        }
        echo "Check logs for errors.\n";
    }

    protected function getUsers($usersJson)
    {
        foreach ($usersJson as $key => $data) {
        }
        return $data;
    }

    public function parseUser($userData, $parser)
    {
        $user = [];
        $user['id'] = $parser->getUuid($userData);
        $user['email'] = $parser->getEmail($userData);
        $user['currency'] = $parser->getCurrency($userData);
        $user['status'] = $parser->getStatus($userData);
        $user['balance'] = $parser->getBalance($userData);
        $user['created_at'] = $parser->getCreatedAt($userData);
        $user['provider'] = $parser->getDataProviderName($userData);
        return $user;
    }

}
