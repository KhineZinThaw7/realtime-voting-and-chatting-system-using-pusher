<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ShowUserList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is to show all users.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo User::all();
    }
}
