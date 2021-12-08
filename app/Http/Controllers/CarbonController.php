<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarbonController extends Controller
{
    public function timeDate(){
        $carbon = new Carbon('first day of December 2021');
        $now = Carbon::now();
        $month = Carbon::now()->month;
        $lastmonth = $now->subMonth();
        $lastyear = $now->subYear();
        $m1 = Carbon::create(2020)->firstOfMonth();
        $m2 = Carbon::create(2020)->lastOfMonth();
        $y1 = Carbon::create(2020)->firstOfYear();   
        $y2 = Carbon::create(2020)->lastOfYear(); 
        $tomorrow = Carbon::tomorrow('Europe/London');

        return $y2;

        $userSettings = [
            'locale' => 'pt',
            'timezone' => 'America/Sao_Paulo',
          ];
          Carbon::macro('userFormat', function () use ($userSettings) {
            return $this->copy()->locale($userSettings['locale'])->tz($userSettings['timezone'])->calendar();
          });
          echo Carbon::yesterday()->hours(11)->userFormat();
    }
    
    public function monthlyEarningGraph(){

        $months = Invoice::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('m');
        });

        return $months;

        $data = Invoice::select(DB::raw('count(id) as `data`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
               ->groupby('monthyear')
               ->get();


        $sales = Invoice::select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'), DB::raw("SUM(payment) as earning"))
               ->groupby('year','month')
               ->orderBy('month', 'desc')
               ->get();

        $data = [];
        foreach($sales as $sale) {
            $data['label'][] = $sale->month;
            $data['earning'][] = (int) $sale->earning;
        }

        $sales= Invoice::select(
            DB::raw('sum(payment) as earning'),
            DB::raw("DATE_FORMAT(created_at,'%M') as months")
        )
            ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
            ->groupBy('months')
            ->get();

        $data = [];
        foreach($sales as $sale) {
            $data['label'][] = $sale->months;
            $data['earning'][] = (int) $sale->earning;
        }

        // last 12 months

        $sales = Invoice::select(
            DB::raw('sum(payment) as earning'), 
            DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->orderBy('created_at', 'desc')
            ->get();
        
        foreach($sales as $sale) {
            $data['label'][] = $sale->months;
            $data['earning'][] = (int) $sale->earning;
        }

        return  $data;

    }

    //Day Week Monthly report
    public function totalEarning(){
        $date = date("Y-m-d");
        $todayTotal = 0;
        $todayInvoice = Invoice::whereDate('updated_at',$date)->get();
        foreach ($todayInvoice as $invoice) {
            $payment = $invoice->payment;
            $todayTotal +=$payment;
        }

        // Last Month Total Sale and average
        $month = new \DateTime;
        $month = date_modify($month, "-1 month");
        $month = $month->format("m");

        if($month == 12){
            $lastYear = new \DateTime;
            $lastYear = date_modify($lastYear, "-1 year");
            $lastYear = $lastYear->format("Y");

            $lastMonthInvoice = Invoice::whereYear('updated_at',$lastYear)->whereMonth('updated_at',$month)->get();
        }else{
            $thisYear = new \DateTime;
            $thisYear = $thisYear->format("Y");

            $lastMonthInvoice = Invoice::whereYear('updated_at',$thisYear)->whereMonth('updated_at',$month)->get();
        }
        
        $monthendTotal = 0;
        $avgSale = 0;
        foreach ($lastMonthInvoice as $invoice) {
            $payment = $invoice->payment;
            $monthendTotal +=$payment;
        }
        $avgSale = round($monthendTotal/30);

        //Current month sales and avg
        $thisMonthInvoice = Invoice::whereMonth('created_at','=',Carbon::now()->month())
        ->whereYear('created_at', date('Y'))
        ->get();
        $monthlyTotal = 0;
        $avg = 0;
        foreach ($thisMonthInvoice as $invoice) {
            $payment = $invoice->payment;
            $monthlyTotal +=$payment;
        }
        $avgSale = round($monthlyTotal/30);

        return response()->json(['todayTotal'=>$todayTotal, 'weekendTotal'=>$weekendTotal, 'monthlyTotal'=>$monthlyTotal, 'avg'=>$avg]);
    }

    public function todaySales(){
        $date = date("Y-m-d");
        $invoice = Invoice::whereDate('updated_at',$date)->with('customer')->with('user')->get();
        return $invoice;
    }

    public function weeklySales(){

        $day1 = new \DateTime;
        $day1 = date_modify($day1, "+1 days");
        $day1 = $day1->format("Y-m-d");

        $day7 = new \DateTime;
        $day7 = date_modify($day7, "-6 days");
        $day7 = $day7->format("Y-m-d");

        $invoice = Invoice::whereBetween('updated_at',[$day7, $day1])->with('customer')->with('user')->get();
        return $invoice;
    }

    public function monthlySales(){

        $month = date("m");
        $year = date("Y");

        $invoice = Invoice::whereYear('updated_at',$year)->whereMonth('updated_at',$month)->with('customer')->with('user')->get();
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

        $invoice = Invoice::whereYear('updated_at',$year)->with('customer')->with('user')->get();
        return $invoice;
    }

     
    public static function getCurrentWeekDays()
    {
        return static function () {
            $startOfWeek = self::this()->startOfWeek()->subDay();
            $weekDays = [];

            for ($i = 0; $i < static::DAYS_PER_WEEK; $i++) {
                $weekDays[] = $startOfWeek->addDay()->startOfDay()->copy();
            }

            return $weekDays;
        };
    }

    public static function getCurrentMonthDays()
    {
        return static function () {
            $date = self::this();
            $startOfMonth = $date->copy()->startOfMonth()->subDay();
            $endOfMonth = $date->copy()->endOfMonth()->format('d');
            $monthDays = [];

            for ($i = 0; $i < $endOfMonth; $i++)
            {
                $monthDays[] = $startOfMonth->addDay()->startOfDay()->copy();
            }

            return $monthDays;
        };
    }

}
