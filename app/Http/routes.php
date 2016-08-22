<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index')->with([
        'meliAppId' => env('API_MELI_APP_ID'),
    ]);
});

Route::post('/login', 'LoginCtrl@login');
Route::get('/logout', 'LoginCtrl@logout');

Route::group(['prefix'=>'register'], function () {
    Route::get('/', 'RegisterCtrl@index');
    Route::get('meli-token', 'RegisterCtrl@finish');
    Route::post('meli-token', 'RegisterCtrl@meliToken');
    Route::post('verify-email', 'RegisterCtrl@verifyExistMail');
});

Route::group(['middleware'=>'auth'], function () {
    Route::get('home', 'HomeCtrl@index');
    Route::get('add-product', 'HomeCtrl@viewAdd');
    Route::get('add-product/ref/{id}', 'HomeCtrl@viewRefProc');
    Route::post('add-product/save', 'HomeCtrl@saveProduct');
});
