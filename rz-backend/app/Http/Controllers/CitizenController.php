<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;
use App\Models\{Citizen, DetailCitizen};

class CitizenController extends Controller
{
    public function index(){
        $citizens = Citizen::with([
            'details' => function($query){
                $query->with('formdata');
                $query->orderBy('sorting', 'asc');
            }
        ])->get();

        return response()->json([
            'data' => $citizens,
            'msg' => 'list data citizen',
            'code' => 200
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'family_card_id' => 'required|unique:citizens',
            "formData" => "required|array|min:1",
        ]);

        $error = null;
        $code = 200;

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'family_card_id' => (string) $request->family_card_id,
        ];

        $details = $request->formData;

        DB::beginTransaction();

        try {

            if ($citizen = Citizen::create($data)) {
                foreach ($details as $i => $detail) {
                    DetailCitizen::create([
                        'citizen_id' => $citizen->family_card_id,
                        'formdata_id' => $detail['id'],
                        'value' => $detail['value'],
                        'sorting' => $detail['sorting'],
                    ]);
                }
            }
            DB::commit();

        } catch (\Throwable $th) {
            $error = $th->getMessage();
            $code = 400;
            DB::rollback();
        }

        return response()->json([
            'data' => [],
            'msg' => $error ?? 'data citizen telah tersimpan',
            'code' => $code
        ], $code);

    }

    public function show($id)
    {
        $citizen = Citizen::with([
            'details' => function ($query) {
                $query->with('formdata');
            }
        ])
        ->where('family_card_id', $id)
        ->first();

        return response()->json([
            'data' => $citizen,
            'msg' => 'list data citizen',
            'code' => 200
        ], 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'family_card_id' => 'required',
            "formData" => "required|array|min:1",
        ]);

        $error = null;
        $code = 200;

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'family_card_id' => (string) $request->family_card_id,
        ];
        
        $details = $request->formData;

        DB::beginTransaction();

        try {

            $citizen = Citizen::where('family_card_id', $request->family_card_id)->first();

            DetailCitizen::where('citizen_id', $request->family_card_id)->delete();

            $citizen->update($data);

            if ($citizen) {
                foreach ($details as $i => $detail) {
                    DetailCitizen::create([
                        'citizen_id' => $citizen->family_card_id,
                        'formdata_id' => $detail['id'],
                        'value' => $detail['value'],
                        'sorting' => $detail['sorting'],
                    ]);
                }
            }

            DB::commit();

        } catch (\Throwable $th) {
            $error = $th->getMessage();
            $code = 400;
            DB::rollback();
        }

        return response()->json([
            'data' => [],
            'msg' => $error ?? 'data citizen telah terupdate',
            'code' => $code
        ], $code);

    }
}
