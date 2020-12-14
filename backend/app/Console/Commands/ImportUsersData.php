<?php

namespace App\Console\Commands;

use App\Models\User;
use JsonMachine\JsonMachine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\DataParsers\DataParserFactory;
use App\DataParsers\UsersDataHydrator;

class ImportUsersData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-users-data:db-store {providerParserName : Defined in each parser class (DataProviderX, DataProviderY)}';

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
        $providerParserName = $this->argument('providerParserName');
        $jsonFileUrl = $this->ask('Enter the json File Url?');
        $resouresArrayPointer = $this->ask('What is resoures Array Pointer? (Default : "/users" )') ?: "/users";

        $parser = DataParserFactory::create($providerParserName);
        $usersData = JsonMachine::fromFile($jsonFileUrl, $resouresArrayPointer);
        $hydator = new UsersDataHydrator($parser, $usersData);

        $count = 0;
        // This can be enhaced to use queue on further scale
        $hydator->apply(function ($user) use (&$count) {
            try {
                User::insert($user);
            } catch (\Throwable $th) {
                Log::error($th);
            }
            echo 'Progress: ' . ++$count . " User/s processed \n";
        });

        echo "Check logs for errors.\n";
    }
}
