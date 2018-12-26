<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('deposit', 'DepositController@index')->name('deposit');
});

Route::post('deposit', 'DepositController@postDeposit')->name('deposit');
Route::get('user_accounts', 'DepositController@getUserAccounts');

Route::get('daily_accrual', 'AccrualController@dailyAccrual')->name('daily_accrual');
