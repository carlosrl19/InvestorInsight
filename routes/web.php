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

// ==============
//  Projects     //
// =============
Route::resource('project', 'App\Http\Controllers\ProjectController')->names('project');
Route::get('project/{id}/report', 'App\Http\Controllers\ProjectController@showReport')->name('project.report');
Route::post('project/{project}/finish', 'App\Http\Controllers\ProjectController@finishProject')->name('project.finish');
Route::post('/project/{project}/close', 'App\Http\Controllers\ProjectController@closeProject')->name('project.close');
Route::get('excel/{id}', 'App\Http\Controllers\ProjectController@export')->name('project.excel');
Route::get('/termination/{id}', 'App\Http\Controllers\ProjectController@downloadTerminationReport')->name('project.termination');

// Terminations
Route::resource('termination', 'App\Http\Controllers\ProjectTerminationController')->names('termination');
Route::get('termination/{id}/report', 'App\Http\Controllers\ProjectTerminationController@showTermination')->name('termination.report');

// Closed
Route::get('closed/', 'App\Http\Controllers\ProjectController@indexClosed')->name('project.closed');