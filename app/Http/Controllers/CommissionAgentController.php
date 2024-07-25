<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommissionAgent\StoreRequest;
use App\Http\Requests\CommissionAgent\UpdateRequest;

use App\Models\CommissionAgent;
use App\Models\Project;
use App\Exports\ActiveCommissionerProjectsExport;
use App\Exports\TerminatedCommissionerProjectsExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CommissionAgentController extends Controller
{

    public function index()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);
    
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        $commission_agents = Cache::remember('commission_agents', $cacheTime, function () {
            return CommissionAgent::get();
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
    
        $commissioner_balance = 0.00;
    
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
        
        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        return view('modules.commission_agent.index', compact(
            'commission_agents',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid',
            'commissioner_balance',
            'loadTime'
        ));
    }

    public function store(StoreRequest $request)
    {
        CommissionAgent::create($request->all());
        return redirect()->route('commission_agent.index')->with('success', 'Comisionista creado exitosamente.');
    }

    public function show($id)
    {
        // Iniciar el temporizador
        $startTime = microtime(true);
    
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        $commissioner = Cache::remember("commissioner_{$id}", $cacheTime, function () use ($id) {
            return CommissionAgent::findOrFail($id);
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
    
        $transfers = Cache::remember("transfers_commissioner_{$id}", $cacheTime, function () use ($commissioner) {
            return DB::table('project_commissioner')
                ->where('commissioner_id', $commissioner->id)
                ->get();
        });
    
        $activeProjects = Cache::remember("active_projects_commissioner_{$id}", $cacheTime, function () use ($commissioner) {
            return DB::table('project_commissioner')
                ->join('projects', 'project_commissioner.project_id', '=', 'projects.id')
                ->where('project_commissioner.commissioner_id', $commissioner->id)
                ->where('projects.project_status', 1)
                ->get();
        });
    
        $completedProjects = Cache::remember("completed_projects_commissioner_{$id}", $cacheTime, function () use ($commissioner) {
            return DB::table('project_commissioner')
                ->join('projects', 'project_commissioner.project_id', '=', 'projects.id')
                ->where('project_commissioner.commissioner_id', $commissioner->id)
                ->where('projects.project_status', 0)
                ->get();
        });

        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;
    
        return view('modules.commission_agent.show', compact(
            'commissioner',
            'transfers',
            'activeProjects',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid',
            'completedProjects', 
            'total_commissioner_commission_payment',
            'loadTime'
        ));
    }

    public function edit($id)
    {
        $commission_agent = CommissionAgent::findOrFail($id);
        return view('modules.commission_agent.index', compact('commission_agent'));
    }

    public function update(UpdateRequest $request, CommissionAgent $commissionAgent)
    {
        $commissionAgent->update($request->all());
        return redirect()->route("commission_agent.index")->with("success", "Comisionista actualizado exitosamente.");
    }

    public function destroy($id)
    {
        $commissionAgent = CommissionAgent::find($id);
    
        if (($commissionAgent->id == 1 || $commissionAgent->commissioner_name == 'JUNIOR AYALA')) {
            return redirect()->route('commission_agent.index')->with('error', 'No se puede eliminar a Junior Ayala de los comisionistas.');
        }
    
        $commissionAgent->delete();
    
        return redirect()->route('commission_agent.index')->with('success', 'Comisionista eliminado exitosamente.');
    }

    public function exportActiveProjects($id)
    {
        $commissioner = CommissionAgent::findOrFail($id);
        $commissionerName = $commissioner->commissioner_name;

        return Excel::download(new ActiveCommissionerProjectsExport($id), 'COMISIONISTA ' . $commissionerName . ' - HISTORIAL DE PROYECTOS ACTIVOS.xlsx');        
    }

    public function exportTerminatedProjects($id)
    {
        $commissioner = CommissionAgent::findOrFail($id);
        $commissionerName = $commissioner->commissioner_name;

        return Excel::download(new TerminatedCommissionerProjectsExport($id), 'COMISIONISTA ' . $commissionerName . ' - HISTORIAL DE PROYECTOS FINALIZADOS.xlsx');        
    }
}
