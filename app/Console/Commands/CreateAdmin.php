<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Classes\PlayerCache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin user';

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
        $profile = null;
        while($profile == null) {
            $username = $this->ask('What is the minecraft username?');
            $profile = PlayerCache::get($username);

            if($profile == null) {
                $this->line('<fg=red>Couldn\'t find that user profile!</>');
            }
        }

        $password = 0; $confirm_password = 1;
        while($password != $confirm_password) {
            $password = $this->secret('Please choose a password');
            $confirm_password = $this->secret('Please type it again');

            if($password != $confirm_password) {
                $this->line('<fg=red>Password didn\'t match!</>');
            }
        }

        $user = new User;
        $user->uuid = PlayerCache::get($username)->uuid;
        $user->password = Hash::make($password);
        $user->save();

        $this->line('<fg=green>User has been created!</>');
    }
}
