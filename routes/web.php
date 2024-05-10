<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::resource('dashboard', 'App\Http\Controllers\DashboardController')->names('dashboard');

// Investor
Route::resource('investor', 'App\Http\Controllers\InvestorController')->names('investor');

// Commission Agent
Route::resource('commission_agent', 'App\Http\Controllers\CommissionAgentController')->names('commission_agent');

// Projects Agent
Route::resource('project', 'App\Http\Controllers\ProjectController')->names('project');