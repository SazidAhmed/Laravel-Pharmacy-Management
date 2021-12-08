<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = auth()->user()->id;
        $cart = DB::table('carts')->where('user_id',Auth::user()->id)->first();
        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }

        return view('home');
    }
}
