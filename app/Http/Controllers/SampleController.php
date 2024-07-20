<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index()
    {
        $sample = Sample::all();
        return response()->json($sample);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "average_intensity" => "required",
            "average_voltage" => "required",
            "absorbance" => "required",
            'concentration'=>'required'
        ]);

        $sample = Sample::create($request->all());
        return response()->json($sample, 200);
    }

    public function show(Request $request)
    {
        $sample = Sample::find($request->id);
        if($sample) {
            return response()->json($sample);
        } else{
            return response()->json([]);
        }
    }

    public function destroy(Request $request)
    {
        $sample = Sample::find($request->id);
        if($sample) {
            $sample->delete();
            return response()->json(['status'=>'success', 'message'=>'Data berhasil dihapus']);
        } else {
            return response()->json(['status'=>'failed', 'message'=>'No Data !'], 400);
        }
    }
}
