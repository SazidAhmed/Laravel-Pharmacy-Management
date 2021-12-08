<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Customer;
use App\Cart;
use App\CartItem;
use App\Invoice;
use App\InvoiceItem;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function downloadCsv()
    {
        $invoice = Invoice::latest()->with('customer')->with('user')->get();
        $collection = collect($invoice)->map(function($item)
        {
            $invoiceItem = InvoiceItem::where('invoice_id',$item->id)->with('medicine')->get();
            $item["invoiceItems"]=$invoiceItem;
            return $item;
        })
        ->all();
        return  $collection;
    }

    //Sales Today
    public function todaySales(){
        // $sales = Invoice::whereDate('created_at', '=', Carbon::today())
        // ->with('customer')->with('user')
        // ->get();

        //With UTC time
        // $date = date("Y-m-d h:i:sa");
        $date = date("Y-m-d");
        $sales = Invoice::whereDate('created_at', $date)
        ->with('customer')->with('user')
        ->orderBy('created_at', 'desc')
        ->get();

        return $sales;
    }

    //Last 7 Days Query
    public function last7DaysSales(){
        $invoice = Invoice::where('created_at', '>', Carbon::today()->subDay(6))->with('customer')->with('user')->get();
        return $invoice;
    }

    //Sales Current Week
    public function weeklySales(){
        $invoice = Invoice::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY),Carbon::now()->endOfWeek(Carbon::FRIDAY)])
        ->with('customer')->with('user')
        ->get();
        return  $invoice;
    }

    //Sales Current Month
    public function monthlySales(){

        $month = date("m");
        $year = date("Y");
        $invoice = Invoice::whereYear('created_at',$year)->whereMonth('created_at',$month)
        ->with('customer')->with('user')
        ->get();
        return $invoice;
    }

    public function lastMonthSales(){

        $month = new \DateTime;
        $month = date_modify($month, "-1 month");
        $month = $month->format("m");

        if($month == 12){
            $lastYear = new \DateTime;
            $lastYear = date_modify($lastYear, "-1 year");
            $lastYear = $lastYear->format("Y");

            $invoice = Invoice::whereYear('updated_at',$lastYear)->whereMonth('updated_at',$month)->with('customer')->with('user')->get();
        }else{
            $thisYear = new \DateTime;
            $thisYear = $thisYear->format("Y");

            $invoice = Invoice::whereYear('updated_at',$thisYear)->whereMonth('updated_at',$month)->with('customer')->with('user')->get();
        }
        return $invoice;
    }

    public function yearlySales(){

        $year = new \DateTime;
        $year = $year->format("Y");

        $invoice = Invoice::whereYear('updated_at',$year)
        ->with('customer')->with('user')
        ->get();
        return $invoice;
    }

    public function lastYearSales(){

        $year = new \DateTime;
        $year = date_modify($year, "-1 year");
        $year = $year->format("Y");

        $invoice = Invoice::whereYear('updated_at',$year)->with('customer')->with('user')->get();
        return $invoice;
    }

    public function byDateSales(Request $request){

        $dateFrom = $request['from'];
        $dateTo = $request['to'];

        if($dateFrom == $dateTo){
            $invoice = Invoice::whereDate('updated_at',$dateFrom)->with('customer')->with('user')->get();
        }
        else{
            $invoice = Invoice::whereBetween('updated_at',[$dateFrom,$dateTo])->with('customer')->with('user')->get();
        }
        return $invoice;
    }


    
}
