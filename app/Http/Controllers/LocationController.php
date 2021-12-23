<?php

namespace App\Http\Controllers;

use App\Distance;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class LocationController extends Controller
{
    public function search_result(Request $request)
    {
        $D = new Distance;

        // return $D->nearby(
        //     new Point(88.38807, 22.62655),
        //     150
        // );

        return $D->nearby(
            new Point(
                $request->latitude,
                $request->longitude
            ),
            $request->radius * 1000
        );
    }
}
