<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Project;
use App\Models\CommissionAgent;


class DashboardController extends Controller
{
    public function index(){
        $investors = Investor::count();
        $commissioner = CommissionAgent::count();
        $project = Project::count();
        return view('modules.dashboard.index', compact('investors', 'commissioner', 'project'));
    }
}