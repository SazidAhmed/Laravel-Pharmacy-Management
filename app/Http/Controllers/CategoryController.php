<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::latest()->get();
        return $categories;
    }

    //single data from category
    public function show($id)
    {
        return Category::find($id);
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:categories',
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png'
            ]);
            $image = $request->file('image');
            $img = $data['name'].time(). '.' .$data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'category'),$img);
        }else{
            $img = 'default.jpg';
        }
        
        $success = Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'image'=>$img
        ]);
        if($success){
            return response()->json($this->index());
        }
        // return redirect()->back()->with('message', 'Category created successfully!');

    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $category = Category::find($id);

        $data = $request->all();
        if($request->hasFile('image')){
            $this->validate($request,[
                'image'=>'required|mimes:jpeg,jpg,png',
            ]);
            $image = $request->file('image');
            $img = $data['name'] . time() . '.' . $data['image']->getClientOriginalExtension();
            $request->image->move(public_path(env('REL_PUB_FOLD').'category'),$img);

            $image_path = public_path(env('REL_PUB_FOLD').'category')."/".$category->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else{
            $img = $category->image;
        }

        $category->name= $request->name;
        $category->slug= Str::slug($request->name);
        $category->image=$img;
        $success = $category->save();
        if($success){
            return response()->json($this->index());
        }
    }

    public function destroy($id)
    {

        $category = Category::find($id);
        $category->delete();
        $image_path = public_path(env('REL_PUB_FOLD').'category')."/".$category->image;  
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        // return redirect()->back()->with('message', 'Category Deleted successfully!');
        return response()->json($this->index());
    }
}
