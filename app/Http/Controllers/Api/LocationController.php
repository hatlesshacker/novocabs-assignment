<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class LocationController extends Controller
{
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $location = $user->Location;

        if ($location == null) {
            $location = Location::create([
                'user_id' => $user->id,
            ]);
        }

        $location->location = new Point(
            $request->lat,
            $request->long
        );

        $location->save();

        return $location;
    }
}
