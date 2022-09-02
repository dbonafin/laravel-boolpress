<?php

use Illuminate\Support\Facades\Route;

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

// If the user is logged, show the admin pages
Route::middleware('auth')
->name('admin.')
->namespace('Admin')
->prefix('admin')
->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
});

Auth::routes();

// If the user is not logged, show the guest pages
Route::get('{any?}', function () {
    return view('welcome');
});

