<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getAllProvinces()
    {
        $provinces = Province::get();
        return response()->json([
            'status' => true,
            'data' => $provinces
        ], 200);
    }

    public function getRegencies($id)
    {
        $regencies = Regency::where('province_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $regencies
        ], 200);
    }

    public function getDistricts($id)
    {
        $regencies = District::where('regency_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $regencies
        ], 200);
    }

    public function getVillages($id)
    {
        $villages = Village::where('district_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $villages
        ], 200);
    }
}
