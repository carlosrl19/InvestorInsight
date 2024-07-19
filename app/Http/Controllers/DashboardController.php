<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\Transfer;
use App\Models\Project;
use App\Models\CreditNote;
use App\Models\PromissoryNote;

class DashboardController extends Controller
{
    public function index(){
        $investors = Investor::count();
        $commissioner = CommissionAgent::count();
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_project_investment_terminated = Project::where('project_status', 0)->sum('project_investment');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');

        $total_investor_profit_payment = DB::table('promissory_notes')
        ->where('promissory_notes.promissoryNote_status', 1)
        ->sum('promissoryNote_amount');

        $total_investor_profit_paid = DB::table('promissory_notes')
        ->where('promissory_notes.promissoryNote_status', 0)
        ->sum('promissoryNote_amount');

        $total_commissioner_commission_paid = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
        ->sum('promissoryNoteCommissioner_amount');
    
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

        $commissioner_id = 1;

        $payments = DB::table('payment_commissioners')
        ->join('projects', 'payment_commissioners.payment_code', '=', 'projects.project_code')
        ->where('payment_commissioners.commissioner_id', $commissioner_id)
        ->select('payment_commissioners.created_at', 
                 DB::raw('SUM(payment_commissioners.payment_amount) as payment_amount'), 
                 'projects.project_name', 
                 'projects.project_investment')
        ->groupBy('payment_commissioners.created_at', 'projects.project_name', 'projects.project_investment')
        ->orderBy('payment_commissioners.created_at')
        ->get();

        return view('modules.dashboard.index', compact(
            'investors',
            'commissioner', 
            
            'total_project_investment',
            'total_project_investment_terminated',
            'total_commissioner_commission_payment', 
            'total_investor_profit_payment', 
            'total_investor_profit_paid',
            'total_commissioner_commission_paid',
            'promissoryNotes',
            'transfers', 
            'creditNotes', 
            'completedProjectsCount', 
            'activeProjectsCount', 
            'closedProjectsCount',
            'payments'
        ));
    }
}