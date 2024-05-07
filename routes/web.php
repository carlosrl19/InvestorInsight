<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.admin');
});

Route::resource('investor', 'App\Http\Controllers\InvestorController')->names('investor');