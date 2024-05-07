<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function() {
    return view('modules.dashboard.index');
});

// Investor
Route::resource('investor', 'App\Http\Controllers\InvestorController')->names('investor');