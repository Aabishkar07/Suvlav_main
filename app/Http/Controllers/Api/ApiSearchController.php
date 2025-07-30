<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiSearchController extends Controller
{
    public function getSearchData()
    {
        error_log("pop");
        $searchhistorys = SearchHistory::orderBy("id", "desc")->get();

        return response()->json([
            'message' => 'User data fetched successfully',
            'data' => $searchhistorys
        ], 200);
    }

    public function postSearchData(Request $request)
    {
        // $abc = $request->searchTerm;
        if ($request->searchTerm) {
            $search = SearchHistory::create([
                'search_item' => $request->searchTerm
            ]);

            return response()->json([
                'message' => 'User data fetched successfully',
                'data' => $search
            ], 200);
        }
    }
    public function postmoreData(Request $request, $id)
    {
        $req = $request->all();

        error_log("Login request23224: ");
        error_log("Login request: " . json_encode($req));
        // error_log("Login request: " . json_encode($request->all()));

        $searchhistorys = SearchHistory::where("id", $id)->first();
        if ($searchhistorys) {
            $searchhistorys->update([
                'name' => $request->name,
                'email' => $request->email,
                'phonenumber' => $request->contact,
                "district" => $request->address
            ]);
        }


        return response()->json([
            'message' => 'Search Data successfully Updated',
            'data' => $searchhistorys
        ], 200);
    }
}
