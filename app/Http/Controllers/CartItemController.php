<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;
use App\Medicine;
use App\Cart;
use App\CartItem;
use App\Invoice;
use App\InvoiceItem;

class CartItemController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('medicine')->latest()->get();
        return $cartItems;
    }

    //Creating CartItems
    public function store(Request $request)
    {
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        $cart_id = $cart->id;
        $qty=1;
        $success = CartItem::create([
            'cart_id'=>$cart_id,
            'medicine_id'=>$request->product_id,
            'qty'=>$qty,
        ]);
        if($success){
            return response()->json($this->index());
        }
    }

    //Updating CartItem Quantity
    public function update(Request $request, $id)
    {
        $cartItem =  CartItem::find($id);

        $cartItem->qty = $request->qty;
        $success=$cartItem->save();
        if($success){
            return response()->json($this->index());
        }
    }

    public function destroy($id)
    {
        $cartItem =  CartItem::find($id);
        $cartItem->delete();
        return response()->json($this->index());
    }
}
