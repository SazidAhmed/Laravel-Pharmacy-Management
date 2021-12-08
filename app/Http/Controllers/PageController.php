<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function categoryPage()
    {
        return view('adminpanel.medicine.category');
    }

    public function manufacturPage()
    {
        return view('adminpanel.medicine.manufact');
    }

    public function unitsPage()
    {
        return view('adminpanel.medicine.units');
    }

    public function productPage()
    {
        return view('adminpanel.medicine.medicine');
    }

    //pos
    public function customerPage()
    {
        return view('adminpanel.pos.customer');
    }

    public function posPage()
    {
        return view('adminpanel.pos.pos');
    }

    public function invoicePage($id)
    {
        return view('adminpanel.pos.invoice',[$id]);
    }

    public function soldItemsPage()
    {
        return view('adminpanel.pos.soldItems');
    }

    public function invoiceRecordsPage()
    {
        return view('adminpanel.pos.invoiceRecords');
    }

    //dashboard
    public function dashboard()
    {
        return view('adminpanel.dashboard');
    }

    //user management
    public function userListPage()
    {
        return view('adminpanel.user.userList');
    }

    public function userProfilePage()
    {
        return view('adminpanel.user.userProfile');
    }

    //report pages
    public function reportDailySales()
    {
        return view('adminpanel.report.reportDailySales');
    }
    public function reportWeeklySales()
    {
        return view('adminpanel.report.reportWeeklySales');
    }
    public function reportMonthlySales()
    {
        return view('adminpanel.report.reportMonthlySales');
    }
    public function reportYearlySales()
    {
        return view('adminpanel.report.reportYearlySales');
    }
}
