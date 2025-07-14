<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NepalController extends Controller
{
    public function index()
    {
        $provinces = Province::get();
        return view("admin.nepal.province.index", compact("provinces"));
    }

    public function create()
    {

        return view("admin.nepal.province.create");
    }
    public function edit(Province $province)
    {

        return view("admin.nepal.province.edit", compact("province"));
    }

    public function togleActiveProvince(Province $province)
    {

        if ($province->is_active == "1") {
            $province->is_active = "0";
        } else {
            $province->is_active = "1";
        }
        $province->save();
        return redirect()->back()->with("popsuccess", "Active Status Changed");
    }

    public function togleActivedistrict(District $district)
    {

        if ($district->is_active == "1") {
            $district->is_active = "0";
        } else {
            $district->is_active = "1";
        }
        $district->save();
        return redirect()->back()->with("popsuccess", "Active Status Changed");
    }


    public function store(Request $request)
    {

        $request->validate([
            "name" => "required"
        ]);

        Province::create([
            "name" => $request->name,
            "is_active" => 1
        ]);

        return redirect()->route("province")->with("success", "Province add");
    }

    public function update(Request $request, Province $province)
    {

        $request->validate([
            "name" => "required"
        ]);

        $province->update([
            "name" => $request->name,
        ]);

        return redirect()->route("province")->with("success", "Province Updated");
    }


    public function delete(Province $province)
    {
        $province->delete();
        return redirect()->back()->with("success", "Province Deleted");
    }

    public function district_index($province)
    {
        // dd($province);

        $title = Province::findOrFail($province)->name;
        $districts = District::where("province", $province)->get();
        return view("admin.nepal.district.index", compact("districts", "title", "province"));
    }
    public function district_create($province)
    {

        $provinces = Province::findOrFail($province);
        return view("admin.nepal.district.create", compact("provinces"));
    }

    public function district_store(Request $request, $province)
    {
        // dd("aa");
        // dd($request);
        $request->validate([
            "name" => "required|unique:districts,district",
        ]);
        District::create([
            "district" => $request->name,
            "province" => $province
        ]);
        return redirect()->route("district.index", $province)->with("success", "District added");
    }

    public function district_edit(District $district)
    {
        $provinces = Province::findOrFail($district->province);

        return view("admin.nepal.district.edit", compact("district", "provinces"));
    }

    public function district_update(Request $request, District $district)
    {
        $request->validate([
            "name" => "required|unique:districts,district," . $district->id,
        ]);
        $district->update([
            "district" => $request->name,
        ]);
        return redirect()->route("district.index", $district->province)->with("success", "District Updated");
    }

    public function district_delete(District $district)
    {
        $province = $district->province;
        $district->delete();
        return redirect()->route("district.index", $province)->with("success", "District Deleted");
    }

    public function municipality(Request $request, District $district)
    {
        // dd($district);
        $title = Province::findOrFail($district->province)->name;

        $municipalities = Municipality::where("district", $district->id)->get();
        return view("admin.nepal.municipality.index", compact("municipalities", 'district', 'title'));
    }

    public function municipality_create(District $district)
    {
        $title = Province::findOrFail($district->province)->name;

        return view("admin.nepal.municipality.create", compact("district", "title"));
    }

    public function municipality_store(Request $request, District $district)
    {
        $request->validate([
            "name" => "required|unique:municipalities,name",
        ]);
        $mun = Municipality::create([
            "name" => $request->name,
            "district" => $district->id,
            "province" => $district->province,
        ]);
        if ($request->ward_to) {
            for ($ward = 1; $ward <= $request->ward_to; $ward++) {
                Ward::create([
                    "number" => $ward,
                    "municipality_id" => $mun->id
                ]);
            }


        }


        return redirect()->route("municipality", $district->id)->with("success", "Municipality Added");
    }

    public function municipality_edit(Municipality $municipality)
    {
        $title = Province::findOrFail($municipality->province)->name;


        $ward = Ward::where("municipality_id", $municipality->id)->max("number");
        return view("admin.nepal.municipality.edit", compact("municipality", 'ward', 'title'));
    }

    public function municipality_update(Request $request, Municipality $municipality)
    {

        $request->validate([
            "name" => "required|unique:municipalities,name," . $municipality->id,
        ]);
        $municipality->update([
            "name" => $request->name,
        ]);
        $highward = Ward::where("municipality_id", $municipality->id)->max("number");

        if ($request->ward_to) {
            if ($request->ward_to != $highward) {
                Ward::where("municipality_id", $municipality->id)->delete();

                for ($ward = 1; $ward <= $request->ward_to; $ward++) {
                    Ward::create([
                        "number" => $ward,
                        "municipality_id" => $municipality->id
                    ]);
                }
            }
        }
        return redirect()->route("municipality", $municipality->district)->with("success", "Municipality Added");
    }

    public function municipality_delete(Municipality $municipality)
    {
        Ward::where("municipality_id", $municipality->id)->delete();

        $district = $municipality->district;
        $municipality->delete();
        return redirect()->route("municipality", $district)->with("success", "Municipality Deleted");
    }
}
