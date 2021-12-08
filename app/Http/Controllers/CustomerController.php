<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Customer;

class CustomerController extends Controller
{
    
    public function index()
    {
        $customers = Customer::latest()->get();
        // return $customers;
        return response()->json($customers);
    }

    public function customerSelect($q)
    {
        return DB::table('customers')->where('name', 'LIKE', '%' . $q . '%')->select('id','name')->paginate(10);
    }

    //single data from Customer
    public function show($id)
    {
        return Customer::find($id);
    }

    // fetch(`/api/customerSelect/${escape(search)}`).then((res) 
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|numeric',
        ]);
        
        $success = Customer::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ]);
        if($success){
            return response()->json($this->index());
        }
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|numeric',
        ]);

        $customer = Customer::find($id);

        $customer->name= $request->name;
        $customer->phone= $request->phone;
        $customer->address= $request->address;
        $success = $customer->save();
        if($success){
            return response()->json($this->index());
        }
    }

    public function destroy($id)
    {

        $customer = Customer::find($id);
        $customer->delete();
        return response()->json($this->index());
    }
}
