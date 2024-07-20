<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SensorController extends Controller
{
    public function index()
    {
        $sensor = Sensor::all();
        return response()->json($sensor);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'uv_reading' => 'required|array',
            'v_reading' => 'required|array',
        ]);

        $sample_id = DB::table('sample')->max('id');
        foreach ($request->uv_reading as $index => $uv_reading) {
            $sensor = new Sensor();
            $sensor->sample_id = $sample_id;
            $sensor->uv_reading = $uv_reading;
            $sensor->v_reading = $request->v_reading[$index];
            $sensor->save();
        };

        return response()->json(['status' => 'success', 'data' => $sensor], 200);
    }

    public function show(Request $request) {
        $sensor = Sensor::find($request->id);
        if($sensor) {
            return response()->json(['status'=>'Success', 'data'=>$sensor], 200);
        } else {
            return response()->json(['status'=>"Failed", 'data'=>[]], 400);
        }
    }
}
