<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//resource Apis
Route::resource('/category', 'CategoryController');
Route::resource('/manufacture', 'ManufacturerController');
Route::resource('/units', 'UnitController');
Route::resource('/medicines', 'MedicineController');

Route::resource('/customer', 'CustomerController');
Route::resource('/cart', 'CartController');

//user management
Route::resource('/users','UserController');


//sold Items api
Route::resource('/soldItems', 'SoldItemsController');

Route::get('/customerSelect/{q}', 'CustomerController@customerSelect');

// Report Apis
Route::get('/todaySales', 'ReportController@todaySales');
Route::get('/weeklySales', 'ReportController@weeklySales');
Route::get('/monthlySales', 'ReportController@monthlySales');
Route::get('/lastMonthSales', 'ReportController@lastMonthSales');

Route::get('/yearlySales', 'ReportController@yearlySales');
Route::get('/lastYearSales', 'ReportController@lastYearSales');
Route::get('/lastMonthSales', 'ReportController@lastMonthSales');

//dashboard apis
Route::get('/countItems', 'DashboardController@countItems');
Route::get('/totalEarning', 'DashboardController@totalEarning');
Route::get('/stockOut', 'DashboardController@stockOut');
Route::get('/expire', 'DashboardController@expire');

//Graph Apis
Route::get('/todayEarningGraph', 'DashboardController@todayEarningGraph');
Route::get('/weeklyEarningGraph', 'DashboardController@weeklyEarningGraph');
Route::get('/monthlyEarningGraph', 'DashboardController@monthlyEarningGraph');
Route::get('/yearlyEarningGraph', 'DashboardController@yearlyEarningGraph');

//Date Time Carbon
Route::get('/timeDate', 'CarbonController@timeDate');