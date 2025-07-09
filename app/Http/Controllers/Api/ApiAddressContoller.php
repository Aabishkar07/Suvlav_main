<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Municipality;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiAddressContoller extends Controller
{
    public function getaddress()
    {
        $states = DB::table('provinces')->where('is_active', '1')
            ->get();
        $municipalities = Municipality::get();
        $districts = DB::table('districts')->where('is_active', 1)->get();
        $wards = Ward::get();

        return response()->json([
            'message' => 'User data fetched successfully',
            'data' => [
                'states' => $states,
                'municipalities' => $municipalities,
                'districts' => $districts,
                'wards' => $wards,
            ]
        ], 200);

    }

}
