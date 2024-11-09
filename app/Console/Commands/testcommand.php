<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class testcommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testcommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 

        foreach (User::all() as $user) {
            User::where('id', $user->id)->update([
                'name' => 'tanate' . $user->id,
                'store_id' => 1,
            ]);
        }

        $this->info('Command executed successfully');
    }
}
