<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;


class GenderController extends Controller
{
    public function index()
    {
        if($gender = Gender::all()){
            return response()->json([
                'data' => $gender,
                'msg' => 'list data gender',
                'status' => 'success'
            ], 200);
        }

        return response()->json([
            'data' => [],
            'msg' => 'list gender not found',
            'status' => 'failed'
        ], 404);
    }
}
