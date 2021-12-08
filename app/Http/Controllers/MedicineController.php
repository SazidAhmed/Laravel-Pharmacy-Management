<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Medicine;

class MedicineController extends Controller
{
    
    public function index()
    {
        $medicines = Medicine::with('category')->with('manufacturer')->with('unit')->latest()->get();
        return $medicines;
    }

    //single data 
    public function show($id)
    {
        return Medicine::find($id);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'name'=>'required',
            'category_id'=>'required',
            'manufacturer_id'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'expire'=>'required',
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $img = $data['name'].time(). '.' .$data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'medicine'),$img);
        }else{
            $img = 'default.jpg';
        }
        
        $success = Medicine::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'manufacturer_id'=>$request->manufacturer_id,
            'unit_id'=>$request->unit_id,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'expire'=>$request->expire,
            'description'=>$request->description,
            'image'=>$img
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

        $medicine = Medicine::find($id);

        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
            $image = $request->file('image');
            $img = $data['name'] . time() . '.' . $data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'medicine'),$img);

            $image_path = public_path(env('REL_PUB_FOLD').'medicine')."/".$medicine->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else{
            $img = $medicine->image;
        }

        $medicine->name=$request->name;
        $medicine->category_id=$request->category_id;
        $medicine->manufacturer_id=$request->manufacturer_id;
        $medicine->unit_id=$request->unit_id;
        $medicine->price=$request->price;
        $medicine->stock=$request->stock;
        $medicine->expire=$request->expire;
        $medicine->description=$request->description;
        $medicine->image=$img;
        $success = $medicine->save();
        if($success){
            return response()->json($this->index());
        }
    }

    public function destroy($id)
    {
        $medicine = Medicine::find($id);
        $medicine->delete();
        $image_path = public_path(env('REL_PUB_FOLD').'medicine')."/".$medicine->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        // return redirect()->back()->with('message', 'Medicine Deleted successfully!');
        return response()->json($this->index());
    }
}
