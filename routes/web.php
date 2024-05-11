<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::resource('dashboard', 'App\Http\Controllers\DashboardController')->names('dashboard');

/* --------------------
    R.R.H.H    Module
=======================*/

// Investor
Route::resource('investor', 'App\Http\Controllers\InvestorController')->names('investor');

// Commission Agent
Route::resource('commission_agent', 'App\Http\Controllers\CommissionAgentController')->names('commission_agent');

/*------------------------
    Accounting   Module
=========================*/

// Transfer
Route::resource('transfer', 'App\Http\Controllers\TransferController')->names('transfer');

/*------------------------
    Project   Module
=========================*/

// Projects
Route::resource('project', 'App\Http\Controllers\ProjectController')->names('project');