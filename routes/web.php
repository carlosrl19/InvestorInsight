<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::resource('dashboard', 'App\Http\Controllers\DashboardController')->names('dashboard');

// Investor
Route::resource('investor', 'App\Http\Controllers\InvestorController')->names('investor');
Route::post('investor/{id}/fund', 'App\Http\Controllers\InvestorController@fund')->name('investor.fund');

// Commission Agent
Route::resource('commission_agent', 'App\Http\Controllers\CommissionAgentController')->names('commission_agent');

// Providers Agent
Route::resource('provider', 'App\Http\Controllers\ProviderController')->names('provider');

// Transfer
Route::resource('transfer', 'App\Http\Controllers\TransferController')->names('transfer');

// Credit note
Route::resource('credit_note', 'App\Http\Controllers\CreditNoteController')->names('credit_note');
Route::get('credit_note/{id}/report', 'App\Http\Controllers\CreditNoteController@showReport')->name('credit_note.report');

// Promissory note investors
Route::resource('promissory_note', 'App\Http\Controllers\PromissoryNoteController')->names('promissory_note');
Route::get('promissory_note/{id}/report', 'App\Http\Controllers\PromissoryNoteController@showReport')->name('promissory_note.report');

// Promissory note commissioners
Route::resource('promissory_note_commissioner', 'App\Http\Controllers\PromissoryNoteCommissionerController')->names('promissory_note_commissioner');
Route::get('promissory_note_commissioner/{id}/report', 'App\Http\Controllers\PromissoryNoteCommissionerController@showReport')->name('promissory_note_commissioner.report');

// Investor payments
Route::resource('payments_investor', 'App\Http\Controllers\PaymentInvestorController')->names('payments_investor');

// Investor funds
Route::resource('investors_funds', 'App\Http\Controllers\InvestorFundsController')->names('investors_funds');

// ==============
//  Projects   //
// =============
Route::resource('project', 'App\Http\Controllers\ProjectController')->names('project');
Route::get('project/{id}/report', 'App\Http\Controllers\ProjectController@showReport')->name('project.report');
Route::post('project/{project}/finish', 'App\Http\Controllers\ProjectController@finishProject')->name('project.finish');
Route::post('/project/{project}/close', 'App\Http\Controllers\ProjectController@closeProject')->name('project.close');

// Excel to projects
Route::get('excel/{id}', 'App\Http\Controllers\ProjectController@export')->name('project.excel');
Route::get('excel/projects/in_process', 'App\Http\Controllers\ProjectController@exportActiveProjects')->name('project.active_projects');
Route::get('excel/projects/in_process/{investorId}', 'App\Http\Controllers\ProjectController@exportActiveInvestorProjects')->name('project.active_investor_projects');

// Terminate project
Route::get('/termination/{id}', 'App\Http\Controllers\ProjectController@downloadTerminationReport')->name('project.termination');

// Project terminations
Route::resource('termination', 'App\Http\Controllers\ProjectTerminationController')->names('termination');
Route::get('termination/{id}/report', 'App\Http\Controllers\ProjectTerminationController@showTermination')->name('termination.report');

// Closed projects
Route::get('closed/', 'App\Http\Controllers\ProjectController@indexClosed')->name('project.closed');