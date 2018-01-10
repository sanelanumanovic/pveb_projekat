<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'RestaurantController@getIndex'));

Route::controller('users', 'UserController');


Route::group(array("before"=>"auth"), function () {

	Route::resource('financies', 'FinancialReportController');

    Route::post('report_request','FinancialReportController@generateReport');

    Route::get("financies/download_excel/{fromDate}/{toDate}/{reportType}", "FinancialReportController@downloadExcelDocument");

});

