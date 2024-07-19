<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommissionAgent\StoreRequest;
use App\Http\Requests\CommissionAgent\UpdateRequest;
use App\Models\CommissionAgent;
use App\Models\Investor;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class CommissionAgentController extends Controller
{

    public function index()
    {
        $commission_agents = CommissionAgent::get();

        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_project_investment_terminated = Project::where('project_status', 0)->sum('project_investment');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');
        
        $commissioner_balance = 0.00;

        $total_investor_profit_payment = DB::table('promissory_notes')
        ->where('promissory_notes.promissoryNote_status', 1)
        ->sum('promissoryNote_amount');

        $total_investor_profit_paid = DB::table('promissory_notes')
        ->where('promissory_notes.promissoryNote_status', 0)
        ->sum('promissoryNote_amount');

        $total_commissioner_commission_paid = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
        ->sum('promissoryNoteCommissioner_amount');

        return view('modules.commission_agent.index', compact(
            'commission_agents',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid',
            'commissioner_balance'
        ));
    }


    public function create()
    {
        //
    }


    public function store(StoreRequest $request)
    {
        CommissionAgent::create($request->all());
        return redirect()->route('commission_agent.index')->with('success', 'Comisionista creado exitosamente.');
    }


    public function show($id)
    {
        $commissioner = CommissionAgent::findOrFail($id);
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');

        $transfers = DB::table('project_commissioner')
        ->where('commissioner_id', $commissioner->id)
        ->get();

        $activeProjects = DB::table('project_commissioner')
        ->join('projects', 'project_commissioner.project_id', '=', 'projects.id')
        ->where('project_commissioner.commissioner_id', $commissioner->id)
        ->where('projects.project_status', 1)
        ->get();

        $completedProjects = DB::table('project_commissioner')
        ->join('projects', 'project_commissioner.project_id', '=', 'projects.id')
        ->where('project_commissioner.commissioner_id', $commissioner->id)
        ->where('projects.project_status', 0)
        ->get();
        
        return view('modules.commission_agent.show', compact('commissioner', 'transfers', 'activeProjects', 'total_project_investment', 'completedProjects',  'total_commissioner_commission_payment'));
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
}
