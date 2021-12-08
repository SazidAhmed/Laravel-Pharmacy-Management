<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Manufacturer;

class ManufacturerController extends Controller
{
    
    public function index()
    {
        $manufacturers = Manufacturer::latest()->get();
        return $manufacturers;
    }

    //single data from manufacturer
    public function show($id)
    {
        return Manufacturer::find($id);
    }

   
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'name'=>'required|unique:manufacturers',
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png'
            ]);
            $image = $request->file('image');
            $img = $data['name'].time(). '.' .$data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'manufacturer'),$img);
        }else{
            $img = 'default.jpg';
        }
        
        $success = Manufacturer::create([
            'name'=>$request->name,
            'image'=>$img
        ]);
        if($success){
            return response()->json($this->index());
        }
        // return redirect()->back()->with('message', 'Manufacturer created successfully!');

    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $manufacturer = Manufacturer::find($id);

        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
            $image = $request->file('image');
            $img = $data['name'] . time() . '.' . $data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'manufacturer'),$img);

            $image_path = public_path(env('REL_PUB_FOLD').'manufacturer')."/".$manufacturer->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else{
            $img = $manufacturer->image;
        }

        $manufacturer->name= $request->name;
        $manufacturer->image=$img;
        $success = $manufacturer->save();
        if($success){
            return response()->json($this->index());
        }
    }

    public function destroy($id)
    {

        $manufacturer = Manufacturer::find($id);
        $manufacturer->delete();
        $image_path = public_path(env('REL_PUB_FOLD').'manufacturer')."/".$manufacturer->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        // return redirect()->back()->with('message', 'Manufacturer Deleted successfully!');
        return response()->json($this->index());
    }
}
