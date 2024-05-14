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

// Credit note
Route::resource('credit_note', 'App\Http\Controllers\CreditNoteController')->names('credit_note');
Route::get('credit_note/{id}/report', 'App\Http\Controllers\CreditNoteController@showReport')->name('credit_note.report');

/*------------------------
    Project   Module
=========================*/

// Projects
Route::resource('project', 'App\Http\Controllers\ProjectController')->names('project');