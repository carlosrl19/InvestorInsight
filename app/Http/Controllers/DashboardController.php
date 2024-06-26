<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\Transfer;
use App\Models\CreditNote;
use App\Models\PromissoryNote;

class DashboardController extends Controller
{
    public function index(){
        $investors = Investor::count();
        $commissioner = CommissionAgent::count();
        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');
    
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
    
        $promissoryNotes = PromissoryNote::latest()->take(25)->get();
        $transfers = Transfer::latest()->take(25)->get();
        $creditNotes = CreditNote::latest()->take(25)->get();
    
        return view('modules.dashboard.index', compact(
            'investors', 
            'commissioner', 
            'total_investor_balance', 
            'total_commissioner_balance', 
            'promissoryNotes',
            'transfers', 
            'creditNotes', 
            'completedProjectsCount', 
            'activeProjectsCount', 
            'closedProjectsCount'
        ));
    }
}