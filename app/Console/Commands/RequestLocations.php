<?php

namespace App\Console\Commands;

use App\Events\LocationUpdateRequest;
use App\Models\User;
use Illuminate\Console\Command;

class RequestLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request Driver Locations';

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
        $allUsers = User::all();

        while (true) {
            $allUsers->each(function ($u) {
                // Only Poll the online drivers

                $this->info("Polling $u->name");
                event(new LocationUpdateRequest($u->id));
            });

            $this->warn("Sleeping for 15 seconds");
            sleep(5);
        }

        return 0;
    }
}
