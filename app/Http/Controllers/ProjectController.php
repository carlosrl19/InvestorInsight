<?php

namespace App\Http\Controllers;

use App\Models\CommissionAgent;
use Illuminate\Http\Request;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Investor;
use App\Models\Project;
use App\Models\Transfer;
use App\Models\PromissoryNote;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::get();
        $investors = Investor::get();
        $generatedCode = strtoupper(Str::random(12)); // Transfer random code
        $commissioners = CommissionAgent::get();
        return view('modules.projects.index', compact('projects', 'investors', 'commissioners', 'generatedCode'));
    }

    public function create()
    {
        return view('modules.projects._create');
    }

    public function store(Request $request)
    {
        $generatedCode = strtoupper(Str::random(12));
        
        // Validar los datos del formulario manualmente
        $validatedData = $request->validate([

            // Project rules
            'project_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:projects,project_name',
            'project_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:projects,project_code',
            'project_estimated_time' => 'required|numeric',
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d',
            'project_investment' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'project_total_worked_days' => 'numeric|min:0|nullable',
            'project_status' => 'required|in:0,1',
            'project_description' => 'required|string|min:3|max:255',

            // Investor array rules
            'investor_id.*' => 'required|numeric|exists:investors,id',
            'investor_investment.*' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'investor_profit_perc.*' => 'required|numeric|min:10|regex:/^\d+(\.\d{1,2})?$/',

            // Commissioner agent rules
            'commissioner_id.*' => 'required|numeric|exists:investors,id',
            'commissioner_commission.*' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'commissioner_profit_perc.*' => 'required|numeric|min:10|max:40|regex:/^\d+(\.\d{1,2})?$/',

            // Transfer rules
            'transfer_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:transfer,transfer_code',
            'transfer_bank' => 'required|string|min:6|max:36|regex:/^[^\d]+$/',
            'transfer_date' => 'required|date_format:Y-m-d\TH:i:s',
            'transfer_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'transfer_description' => 'required|string|min:3|max:255',
        ]);
        
        // Si llega a este punto, los datos han sido validados correctamente se continúa con el proceso
        $investorId = $validatedData['investor_id'];
        $investor_investment = $validatedData['investor_investment'];
        $investor_profit_perc = $validatedData['investor_profit_perc'];
        
        // Commissioner data validation
        $commissionerId = $validatedData['commissioner_id'];
        $commissioner_commission = $validatedData['commissioner_commission'];
        $commissioner_profit_perc = $validatedData['commissioner_profit_perc'];
    
        // Iteration on names and percentages to store them in the database
        for ($i = 0; $i < count($investorId); $i++) {
            $project = new Project();
            $project->project_name = $validatedData['project_name'];
            $project->project_code = $validatedData['project_code'];
            $project->project_estimated_time = $validatedData['project_estimated_time'];
            $project->project_start_date = $validatedData['project_start_date'];
            $project->project_end_date = $validatedData['project_end_date'];
            $project->project_investment = $validatedData['project_investment'];
            $project->investor_profit_perc = $validatedData['investor_profit_perc'];
            $project->project_total_worked_days = $validatedData['project_total_worked_days'];
            $project->project_status = $validatedData['project_status'];
            $project->project_description = $validatedData['project_description'];
            
            // Investor array
            $project->investor_id = $investorId[$i];
            $project->investor_investment = $investor_investment[$i];
            $project->investor_profit_perc = $investor_profit_perc[$i];

            // Commissioner array
            $project->commissioner_id = $commissionerId[$i];
            $project->commissioner_commission = $commissioner_commission[$i];
            $project->commissioner_profit_perc = $commissioner_profit_perc[$i];

            $project->save();
    
            // Crear pagaré para cada inversionista del proyecto
            $promissoryNoteCode = \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Ymd') . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            
            PromissoryNote::create([
                'investor_id' => $investorId[$i],
                'promissoryNote_emission_date' => \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d'),
                'promissoryNote_final_date' => \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->addMonth()->format('Y-m-d'),
                'promissoryNote_amount' => $investor_investment[$i],
                'promissoryNote_code' => $promissoryNoteCode,
                'promissoryNote_status' => 1,
            ]);
        }
    
        // Crear transferencia
        Transfer::create([
            'transfer_code' => $generatedCode,
            'transfer_bank' => $validatedData['transfer_bank'],
            'investor_id' => $validatedData['investor_id'][0], // Asumiendo que la transferencia está relacionada con el primer inversionista
            'transfer_date' => $validatedData['transfer_date'],
            'transfer_amount' => $validatedData['transfer_amount'],
            'transfer_description' => $validatedData['transfer_description'],
        ]);
        
        return redirect()->route('project.index')->with('success', 'Proyecto, pagaré y transferencia creados de manera exitosa.');
    }
    public function show($id)
    {
        // Encuentra el proyecto por su ID
        $project = Project::findOrFail($id);
    
        // Encuentra todos los inversores donde el project_name coincide con el del proyecto encontrado
        $investors = Project::where('project_name', $project->project_name)->with('investor') // Eager load the investor relationship
            ->get()
            ->pluck('investor');
    
        // Pasa los inversores y el proyecto a la vista
        return view('modules.projects.show', [
            'project' => $project,
            'investors' => $investors
        ]);
    }
    
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('modules.projects.update', compact('project'));
    }

    public function update(UpdateRequest $request, Project $project)
    {
        $project->update($request->all());
        return redirect()->route("project.index")->with("success", "Proyecto actualizado exitosamente.");
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return redirect()->route('project.index')->with('success', 'Proyecto eliminado exitosamente.');
    }
}
