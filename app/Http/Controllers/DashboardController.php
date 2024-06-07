<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Investor;
use App\Models\Project;
use App\Models\CommissionAgent;
use App\Models\Transfer;
use App\Models\CreditNote;

class DashboardController extends Controller
{
    public function index(){
        $investors = Investor::count();
        $commissioner = CommissionAgent::count();
        $total_investor_balance = Investor::sum('investor_balance');

        $completedProjectsCount = DB::table('projects')
        ->where('projects.project_status', 0)
        ->get()
        ->count();

        $activeProjectsCount = DB::table('projects')
        ->where('projects.project_status', 1)
        ->get()
        ->count();

        $closedProjectsCount = DB::table('projects')
        ->where('projects.project_status', 2)
        ->get()
        ->count();

        $transfers = Transfer::latest()->take(25)->get();
        $creditNotes = CreditNote::latest()->take(25)->get();

        return view('modules.dashboard.index', compact('investors', 'commissioner', 'total_investor_balance', 'transfers', 'creditNotes', 'completedProjectsCount', 'activeProjectsCount', 'closedProjectsCount'));
    }
}
