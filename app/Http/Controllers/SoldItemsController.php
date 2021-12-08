<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Medicine;
use App\Invoice;
use App\InvoiceItem;

class SoldItemsController extends Controller
{
    public function index()
    {
        $soldItems = InvoiceItem::with('medicine')->latest()
        ->get();
        return $soldItems;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
