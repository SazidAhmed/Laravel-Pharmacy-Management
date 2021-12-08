<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Unit;

class UnitController extends Controller
{
    
    public function index()
    {
        $units = Unit::latest()->get();
        return $units;
    }

    //single data from Unit
    public function show($id)
    {
        return Unit::find($id);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:units',
        ]);

        $success = Unit::create([
            'name'=>$request->name,
        ]);
        if($success){
            return response()->json($this->index());
        }

    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $Unit = Unit::find($id);
        $Unit->name= $request->name;
        $success = $Unit->save();
        if($success){
            return response()->json($this->index());
        }
    }

    public function destroy($id)
    {
        $Unit = Unit::find($id);
        $Unit->delete();
        return response()->json($this->index());
    }
}
