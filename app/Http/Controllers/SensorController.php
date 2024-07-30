<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SensorController extends Controller
{
    public function index(Request $request)
    {
        $sample_id = $request->query('sample_id');
        // Memeriksa apakah 'sample_id' diberikan
        if ($sample_id) {
            // Mendapatkan data sensor yang sesuai dengan sample_id
            $sensor = Sensor::where('sample_id', $sample_id)->get();
        } else {
            // Jika tidak ada sample_id yang diberikan, ambil semua data sensor
            $sensor = Sensor::all();
        }
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

    public function show($id)
    {
        $sensor = Sensor::find($id);
        if ($sensor) {
            return response()->json(['status' => 'Success', 'data' => $sensor], 200);
        } else {
            return response()->json(['status' => "Failed", 'data' => []], 400);
        }
    }
}
