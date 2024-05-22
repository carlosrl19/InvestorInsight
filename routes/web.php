<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::resource('dashboard', 'App\Http\Controllers\DashboardController')->names('dashboard');

// Investor
Route::resource('investor', 'App\Http\Controllers\InvestorController')->names('investor');

// Commission Agent
Route::resource('commission_agent', 'App\Http\Controllers\CommissionAgentController')->names('commission_agent');

// Transfer
Route::resource('transfer', 'App\Http\Controllers\TransferController')->names('transfer');

// Credit note
Route::resource('credit_note', 'App\Http\Controllers\CreditNoteController')->names('credit_note');
Route::get('credit_note/{id}/report', 'App\Http\Controllers\CreditNoteController@showReport')->name('credit_note.report');

// Promissory note
Route::resource('promissory_note', 'App\Http\Controllers\PromissoryNoteController')->names('promissory_note');
Route::get('promissory_note/{id}/report', 'App\Http\Controllers\PromissoryNoteController@showReport')->name('promissory_note.report');

// Projects
Route::resource('project', 'App\Http\Controllers\ProjectController')->names('project');
Route::get('project/{id}/report', 'App\Http\Controllers\ProjectController@showReport')->name('project.report');