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

    public function shippingaddress($userid)
    {
        $shipping = DB::table('shippings')->where('member_id', $userid)->first();
        return response()->json([
            'message' => 'User data fetched successfully',
            'data' => $shipping
        ], 200);
    }
    public function updateshippingaddress(Request $request, $userid)
    {
        try {
            $allData = $request->all();
            $shipping = DB::table('shippings')->where('member_id', $userid)->first();
           
            if (!$shipping) {
                return response()->json([
                    'message' => 'Shipping address not found for the user.',
                ], 404);
            }

            $check = DB::table('shippings')->where('member_id', $userid)->update([
                "fullname" => $allData["name"],
                "mobile" => $allData["phone"],
                "email" => $allData["email"],
                "province" => (int) $allData["state"],
                "district_id" => (int) $allData["district"],
                "nagarpalika" => $allData["municipality"],
                "wardno" => $allData["ward"],
                "tole" => $allData["tole"],
            ]);
           

            return response()->json([
                'message' => 'User data updated successfully',
                'data' => DB::table('shippings')->where('member_id', $userid)->first()
            ], 200);
        } catch (\Exception $e) {
            error_log("Error: " . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred while updating the shipping address.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
