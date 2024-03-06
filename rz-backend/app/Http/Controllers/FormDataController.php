<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;

class FormDataController extends Controller
{
    public function index()
    {
        if ($formdata = FormData::orderBy('sorting', 'asc')->get()) {
            return response()->json([
                'data' => $formdata,
                'msg' => 'list formdata',
                'status' => 'success'
            ], 200);
        }

        return response()->json([
            'data' => [],
            'msg' => 'list formdata not found',
            'status' => 'failed'
        ], 404);
    }
}
