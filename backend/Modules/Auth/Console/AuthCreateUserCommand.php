<?php

namespace Modules\Auth\Console;

use Illuminate\Console\Command;
use Modules\Auth\Entities\User;
use Modules\Strategy\Services\Client\AccountClient;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AuthCreateUserCommand extends Command
{
    protected $userId;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:create {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create auth user';

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
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->argument('user');
        $account = self::account($userId);

        if($account['data']) {
            $data = $account['data']['account'] ?? $account['data']['user'];
            User::saveAccount($data, $userId);
        }
    }

    private static function account($userId)
    {
        $client = new AccountClient($userId);
        $client->query();
        return $client->getResult();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
