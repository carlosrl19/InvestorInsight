<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Investor;
use App\Models\Project;
use App\Models\PromissoryNote;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::get();
        $investors = Investor::get();
        return view('modules.projects.index', compact('projects', 'investors'));
    }

    public function create()
    {
        return view('modules.projects._create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario manualmente
        $validatedData = $request->validate([
            'project_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:projects,project_name',
            'project_code' => 'required|string|min:16|max:16|regex:/^[a-zA-Z0-9]+$/|unique:projects,project_code',
            'project_estimated_time' => 'required|numeric',
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d',
            'project_investment' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'project_total_worked_days' => 'numeric|min:0|nullable',
            'project_status' => 'required|in:0,1',
            'investor_id.*' => 'required|numeric|exists:investors,id',
            'investor_investment.*' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'investor_profit_perc.*' => 'required|numeric|min:10|regex:/^\d+(\.\d{1,2})?$/',
            'project_description' => 'required|string|min:3|max:255',
        ]);
        
        // Si llega a este punto, los datos han sido validados correctamente
        // Continúa con el proceso de almacenamiento en la base de datos
        $investorId = $validatedData['investor_id'];
        $investor_investment = $validatedData['investor_investment'];
        $investor_profit_perc = $validatedData['investor_profit_perc'];
    
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
            
            $project->investor_id = $investorId[$i];
            $project->investor_investment = $investor_investment[$i];
            $project->investor_profit_perc = $investor_profit_perc[$i];
            $project->project_description = $validatedData['project_description'];
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
        
        return redirect()->route('project.index')->with('success', 'Proyecto creado de manera exitosa.');
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
