<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Auth::routes();

//Pages get routes
Route::get('dashboard/','PageController@dashboard')->name('dashboard')->middleware('auth');

Route::get('categorypage/','PageController@categoryPage')->name('categorypage')->middleware('auth');
Route::get('unitspage/','PageController@unitsPage')->name('unitspage')->middleware('auth');
Route::get('manufacturpage/','PageController@manufacturPage')->name('manufacturpage')->middleware('auth');
Route::get('productpage/','PageController@productPage')->name('productpage')->middleware('auth');
Route::get('customerpage/','PageController@customerPage')->name('customerpage')->middleware('auth');
Route::get('pospage/','PageController@posPage')->name('pospage')->middleware('auth');
Route::get('invoicepage/{id?}','PageController@invoicepage')->name('invoicepage')->middleware('auth');
Route::get('invoiceRecordspage/','PageController@invoiceRecordsPage')->name('invoiceRecordspage')->middleware('auth');
Route::get('soldItems/','PageController@soldItemsPage')->name('soldItems')->middleware('auth');
//User Management
Route::get('userListPage/','PageController@userListPage')->name('userList')->middleware('auth');
Route::get('userProfilePage/','PageController@userProfilePage')->name('userProfile')->middleware('auth');

//Report pages
Route::get('reportDailySales/','PageController@reportDailySales')->name('reportDailySales')->middleware('auth');
Route::get('reportWeeklySales/','PageController@reportWeeklySales')->name('reportWeeklySales')->middleware('auth');
Route::get('reportMonthlySales/','PageController@reportMonthlySales')->name('reportMonthlySales')->middleware('auth');
Route::get('reportYearlySales/','PageController@reportYearlySales')->name('reportYearlySales')->middleware('auth');

// Cart routes
Route::post('/insertCustomer', 'CartController@insertCustomer');
// Cart Item routes
Route::resource('/cartItem', 'CartItemController');
//Invoice routes
Route::resource('/invoice', 'InvoiceController');
//generating Invoice
Route::get('/getInvoice', 'InvoiceController@getInvoice');
//All Invoice List record
Route::get('/getInvoiceList', 'InvoiceController@getInvoiceList');
//generating Invoice
Route::get('/invoiceGenerator/{id?}', 'InvoiceController@invoiceGenerator');

// user Profile
Route::get('/userprofile','UserController@userProfile');
