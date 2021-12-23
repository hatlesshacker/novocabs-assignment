<?php

namespace App;

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\DB;

class Distance
{
    protected $conn;

    function __construct()
    {
        $this->conn = mysqli_connect(
            env("DB_HOST"),
            env("DB_USERNAME"),
            env("DB_PASSWORD"),
            env("DB_DATABASE")
        );
    }

    public function nearby(Point $user, $distance)
    {
        $user_lat = $user->getLat();
        $user_long = $user->getLng();

        return DB::table('locations')
            ->select(
                DB::raw("
                    ST_AsText(`location`) AS `pos_wkt`,
                    ST_Distance_Sphere(`location`, ST_GeomFromText('POINT($user_lat $user_long)', 4326)) AS `distance`")
            )
            ->whereRaw("ST_Distance_Sphere(`location`, ST_GeomFromText('POINT($user_lat $user_long)', 4326)) <= $distance")
            ->get();
    }
}
