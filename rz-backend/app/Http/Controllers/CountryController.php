<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;


class CountryController extends Controller
{
    public function index(){
        if ($countries = Country::orderBy('id', 'asc')->get()) {
            return response()->json([
                'data' => $countries,
                'msg' => 'list data country',
                'status' => 'success'
            ], 200);
        }

        return response()->json([
            'data' => [],
            'msg' => 'list country not found',
            'status' => 'failed'
        ], 404);
    }
}
