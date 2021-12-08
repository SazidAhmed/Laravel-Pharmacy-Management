<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Customer;
use App\Medicine;
use App\Cart;
use App\CartItem;
use App\Invoice;
use App\InvoiceItem;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::latest()->get();
        return $invoice;
    }
    //All Invoice
    public function getInvoiceList()
    {
        $invoice = Invoice::latest()->with('customer')->with('user')->get();
        return $invoice;
    }

    //Show Single InvoiceItems
    public function show($id)
    {
        $invoice = InvoiceItem::where('invoice_id',$id)->with('medicine')->get();
        return $invoice;
    }

    //Generating Invoice with collection
    public function invoiceGenerator($id)
    {
        $invoice = Invoice::where('id',$id)->with('customer')->first();
        $data = InvoiceItem::where('invoice_id',$invoice->id)->with('medicine')->get();
        $collection = collect($invoice);
        $collection->put('invoiceItems',  $data);
        return  $collection;
    }
   
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id',$user_id)->first();
        $customer_id = $cart->customer_id;
        $cartItem = CartItem::all();
        $payment = 0;
        foreach ($cartItem as $item) {
            $qty=$item->qty;
            $price=$item->medicine->price;
            $amount=$price*$qty;
            $payment = $payment + $amount;
        }
        //Creting Invoice
        Invoice::create([
            'user_id'=>$user_id,
            'customer_id'=>$customer_id,
            'payment'=>$payment,
        ]);
        //Creating InvoiceItem from CartItem
        $invoice_id = DB::getPdo()->lastInsertId();

        foreach ($cartItem as $item) {
            
            $qty=$item->qty;
            $price=$item->medicine->price;
            $amount=$price*$qty;

            $medicine = Medicine::where('id',$item->medicine_id)->first();
            if($medicine->stock > 0){
                $medicine->stock = $medicine->stock - $qty;
                if($medicine->stock < 0){
                    return response()->json([
                        'errors' => [
                          'name' => $medicine->name,
                        ]
                      ], 422);
                }
                else{
                    $medicine->save();

                    InvoiceItem::create([
                        'invoice_id'=>$invoice_id,
                        'medicine_id'=>$item->medicine_id,
                        'qty'=>$item->qty,
                        'amount'=>$amount,
                ]);
                //Removing each Item from CartItem
                $item->delete();
                }
            }
            else{
                return response()->json([
                    'errors' => [
                      'name' => $medicine->name,
                    ]
                  ], 422);
            } 
          }
        //customer_id Set Null in Cart
        $cart->customer_id = null;
        $success=$cart->save();
        if($success){
            return response()->json($invoice_id);
        }
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $invoice= Invoice::find($id);
        $invoice->delete();
        return response()->json($this->index());
    }

}
