<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\User;
use App\Customer;
use App\Cart;
use App\CartItem;
use App\Invoice;
use App\InvoiceItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::latest()->get();
        return $cart;
    }

 
    public function store(Request $request)
    {
        
    }

    //Adding Customer_ID in Cart
    public function insertCustomer(Request $request)
    {
        // dd(auth()->user()->id);
        // $user=Auth::user()->id;
        // dd($user);
        // $user_id = DB::table('users')->where('id',Auth::user()->id)->first();
        if (Auth::check()){
            
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            
            $cart->customer_id = $request->customer_id;
            $success=$cart->save();
            if($success){
                return response()->json($this->index());
            }
        }   
    }

    
    public function update(Request $request, $id)
    {
        
    }

}
