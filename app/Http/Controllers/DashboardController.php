<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Category;
use App\Manufacturer;
use App\Customer;
use App\Medicine;
use App\Invoice;
use App\InvoiceItem;
use Response;
use Carbon\Carbon;
 
class DashboardController extends Controller
{
    public function countItems(){
        // Counts
        $countCat = Category::get()->count();
        $countManu = Manufacturer::get()->count();
        $countMed = Medicine::get()->count();
        $countCus = Customer::get()->count();  

        return response()->json(['countCat'=>$countCat,'countManu'=>$countManu,'countMed'=>$countMed,'countCus'=>$countCus]);
    }

    public function totalEarning(){
        $todayTotal = 0;
        $todayInvoice = Invoice::whereDate('created_at', '=', Carbon::today())->get();
        foreach ($todayInvoice as $invoice) {
            $payment = $invoice->payment;
            $todayTotal +=$payment;
        }
        
        //Current Week Total Sale
        $thisWeekTotal = 0;
        $thisWeekInvoice = Invoice::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY),Carbon::now()->endOfWeek(Carbon::FRIDAY)])
        ->get();
        foreach ($thisWeekInvoice as $invoice) {
            $payment = $invoice->payment;
            $thisWeekTotal +=$payment;
        }
       
        //Current month sales and avg
        $thisMonthInvoice = Invoice::whereMonth('created_at','=',Carbon::now()->month())
        ->whereYear('created_at', date('Y'))
        ->get();
        $thisMonthTotal = 0;
        $monthlyAvg = 0;
        foreach ($thisMonthInvoice as $invoice) {
            $payment = $invoice->payment;
            $thisMonthTotal +=$payment;
        }

        $monthlyAvg = round($thisMonthTotal/30);

        return response()->json(['todayTotal'=>$todayTotal, 'thisWeekTotal'=>$thisWeekTotal, 'thisMonthTotal'=>$thisMonthTotal, 'monthlyAvg'=>$monthlyAvg]);
    }

    // Sales Difference between Today and Yesterday
    public function todayEarningGraph(){

        // $t = Carbon::today();
        // $y = Carbon::yesterday()->toDateString();

        $sales = Invoice::select(DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"), DB::raw("SUM(payment) as earning"))
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', Carbon::now()->month())
        ->where('created_at', '>', Carbon::today()->subDay())
        ->groupBy('day_name','day')
        ->orderBy('day', 'asc')
        ->get();

        $data = [];
        foreach($sales as $sale) {
        $data['label'][] = $sale->day_name;
        $data['earning'][] = (int) $sale->earning;
        }
        return  $data;
    }

    // Last 7 days including today
    public function last7daysEarningGraph(){

        $sales = Invoice::select(DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"), \DB::raw("SUM(payment) as earning"))
        ->whereMonth('created_at', Carbon::now()->month())
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day', 'desc')
        ->get();

        $data = [];
        foreach($sales as $sale) {
        $data['label'][] = $sale->day_name;
        $data['earning'][] = (int) $sale->earning;
        }
     
        // $data['chart_data'] = json_encode($data);
        return  $data;
    }

    // Current Week Earning Graph
    public function weeklyEarningGraph(){

        $sales = Invoice::select(DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"), \DB::raw("SUM(payment) as earning"))
        ->whereMonth('created_at', Carbon::now()->month())
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY),Carbon::now()->endOfWeek(Carbon::FRIDAY)])
        ->groupBy('day_name','day')
        ->orderBy('day', 'desc')
        ->get();

        $data = [];
        foreach($sales as $sale) {
        $data['label'][] = $sale->day_name;
        $data['earning'][] = (int) $sale->earning;
        }
        
        // $data['chart_data'] = json_encode($data);
        return  $data;
    }

    // Current Monthly Earning Graoh
    public function monthlyEarningGraph(){

        $sales= Invoice::select(
            DB::raw("DATE_FORMAT(created_at,'%D-%b') as months"),
            DB::raw('sum(payment) as earning'),
        )
            ->whereMonth('created_at','=',Carbon::now()->month())
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->orderBy('created_at', 'desc')
            ->get();

        $data = [];
        foreach($sales as $sale) {
            $data['label'][] = $sale->months;
            $data['earning'][] = (int)$sale->earning;
        }
        return  $data;
    }


    // Yearly earning
    public function yearlyEarningGraph(){

        $sales = Invoice::select(
            DB::raw('sum(payment) as earning'), 
            DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->orderBy('created_at', 'desc')
            ->get();
        $data = [];
        foreach($sales as $sale) {
            $data['label'][] = $sale->months;
            $data['earning'][] = (int) $sale->earning;
        }

        return  $data;
    }

    //StockOut Notification
    public function stockOut(){
        $medicine = Medicine::whereBetween('stock', [0, 1])->get();
        return $medicine;
        // return response()->json(['name' => $name ]);
    }

    //Expire Date Notification
    public function expire(){
        $day1 = new \DateTime;
        // $day1 = date_modify($day1, "+1 days");
        $day1 = $day1->format("Y-m-d");

        $day5 = new \DateTime;
        $day5 = date_modify($day5, "+5 days");
        $day5 = $day5->format("Y-m-d");

        $medicine = Medicine::whereBetween('expire',[$day1, $day5])->get();
        return response()->json($medicine );
    }

}
