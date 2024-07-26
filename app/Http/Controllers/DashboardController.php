<?php

namespace App\Http\Controllers;

use App\Exports\GeneralExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\Transfer;
use App\Models\Project;
use App\Models\CreditNote;
use App\Models\PromissoryNote;

use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);

        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora

        $investors = Cache::remember('investors_count', $cacheTime, function () {
            return Investor::count();
        });

        $commissioner = Cache::remember('commissioner_count', $cacheTime, function () {
            return CommissionAgent::count();
        });

        $total_project_investment = Cache::remember('total_project_investment', $cacheTime, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });

        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', $cacheTime, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });

        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });

        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 1)
                ->sum('promissoryNote_amount');
        });

        $total_investor_profit_paid = Cache::remember('total_investor_profit_paid', $cacheTime, function () {
            return DB::table('promissory_notes')
                ->where('promissory_notes.promissoryNote_status', 0)
                ->sum('promissoryNote_amount');
        });

        $total_commissioner_commission_paid = Cache::remember('total_commissioner_commission_paid', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
                ->sum('promissoryNoteCommissioner_amount');
        });

        $completedProjectsCount = Cache::remember('completed_projects_count', $cacheTime, function () {
            return DB::table('projects')
                ->where('projects.project_status', 0)
                ->get()
                ->count();
        });

        $activeProjectsCount = Cache::remember('active_projects_count', $cacheTime, function () {
            return DB::table('projects')
                ->where('projects.project_status', 1)
                ->get()
                ->count();
        });

        $closedProjectsCount = Cache::remember('closed_projects_count', $cacheTime, function () {
            return DB::table('projects')
                ->where('projects.project_status', 2)
                ->get()
                ->count();
        });

        $promissoryNotes = Cache::remember('promissory_notes_latest_10', $cacheTime, function () {
            return PromissoryNote::latest()->take(10)->get();
        });

        $transfers = Cache::remember('transfers_latest_10', $cacheTime, function () {
            return Transfer::latest()->take(10)->get();
        });

        $creditNotes = Cache::remember('credit_notes_latest_10', $cacheTime, function () {
            return CreditNote::latest()->take(10)->get();
        });

        $commissioner_id = 1;

        $payments = Cache::remember("payments_commissioner_{$commissioner_id}", $cacheTime, function () use ($commissioner_id) {
            return DB::table('payment_commissioners')
                ->join('projects', 'payment_commissioners.payment_code', '=', 'projects.project_code')
                ->where('payment_commissioners.commissioner_id', $commissioner_id)
                ->select(
                    'payment_commissioners.created_at',
                    DB::raw('SUM(payment_commissioners.payment_amount) as payment_amount'),
                    'projects.project_name',
                    'projects.project_investment'
                )
                ->groupBy('payment_commissioners.created_at', 'projects.project_name', 'projects.project_investment')
                ->orderBy('payment_commissioners.created_at')
                ->get();
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

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
            'payments',
            'loadTime'
        ));
    }

    public function generalExport()
    {
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->locale('es')->translatedFormat('d F Y'); // Mes con nombre completo en español
        $todayDate = str_replace(Carbon::now()->translatedFormat('F'), strtoupper(Carbon::now()->translatedFormat('F')), $todayDate); // Uppercase para el nombre del mes
    
        return Excel::download(new GeneralExport, 'REPORTE GENERAL ' . $todayDate . ' - EXCEL.xlsx');
    }   
}
