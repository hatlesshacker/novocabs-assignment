<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(10)
            ->create()
            ->each(function ($u) {
                $lat = 22.62745 + (0.0001 * rand(-1, +1));
                $long = 88.38917 + (0.0001 * rand(-1, 0));

                $loc = Location::create([
                    'user_id' => $u->id,
                ]);

                $loc->location = new Point($lat, $long);
                $loc->save();
            });
    }
}
