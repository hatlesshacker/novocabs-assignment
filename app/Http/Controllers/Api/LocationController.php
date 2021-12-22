<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function update(Request $request, $user_id)
    {
        return [
            $user_id,
            $request->all()
        ];
    }
}
