<?php

namespace App\Http\Controllers;

use App\Models\CommissionAgent;
use Illuminate\Http\Request;
use App\Http\Requests\Project\StoreRequest;
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
        $commissioners = CommissionAgent::get();
        $generatedCode = strtoupper(Str::random(12)); // Transfer random code

        return view('modules.projects.index', compact('projects', 'investors', 'commissioners', 'generatedCode'));
    }

    public function create()
    {
        return view('modules.projects._create');
    }

    public function store(StoreRequest $request)
    {
        $generatedCode = strtoupper(Str::random(12));
    
        // Validar los datos del formulario manualmente
        $validatedData = $request->validated();
    
        // Crear proyecto
        $project = Project::create([
            'project_name' => $validatedData['project_name'],
            'project_code' => $validatedData['project_code'],
            'project_start_date' => $validatedData['project_start_date'],
            'project_end_date' => $validatedData['project_end_date'],
            'project_work_days' => $validatedData['project_work_days'],
            'project_investment' => $validatedData['project_investment'],
            'project_status' => $validatedData['project_status'],
            'project_comment' => $validatedData['project_comment'],
        ]);
    
        // Asociar inversionistas con el proyecto
        if (is_array($validatedData['investor_id'])) {
            foreach ($validatedData['investor_id'] as $i => $invId) {
                $project->investors()->attach($invId, [
                    'investor_investment' => $validatedData['investor_investment'][$i],
                    'investor_profit' => $validatedData['investor_profit'][$i],
                ]);

                // Crear pagaré para cada inversionista del proyecto
                $promissoryNoteCode = \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Ymd') . str_pad($i + 1, 4, '0', STR_PAD_LEFT);

                PromissoryNote::create([
                    'investor_id' => $invId,
                    'promissoryNote_emission_date' => \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d'),
                    'promissoryNote_final_date' => \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->addMonth()->format('Y-m-d'),
                    'promissoryNote_amount' => $validatedData['investor_investment'][$i],
                    'promissoryNote_code' => $promissoryNoteCode,
                    'promissoryNote_status' => 1,
                ]);
            }
        } else {
            // Solo hay un inversionista
            $invId = $validatedData['investor_id'];
            $project->investors()->attach($invId, [
                'investor_investment' => $validatedData['investor_investment'],
                'investor_profit' => $validatedData['investor_profit'],
                'investor_final_profit' => $validatedData['investor_final_profit'],
            ]);

            // Crear pagaré para el inversionista del proyecto
            $promissoryNoteCode = \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Ymd') . '0001';

            PromissoryNote::create([
                'investor_id' => $invId,
                'promissoryNote_emission_date' => \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d'),
                'promissoryNote_final_date' => \Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->addMonth()->format('Y-m-d'),
                'promissoryNote_amount' => $validatedData['investor_investment'],
                'promissoryNote_code' => $promissoryNoteCode,
                'promissoryNote_status' => 1,
            ]);
        }

        // Asociar comisionistas con el proyecto
        foreach ($validatedData['commissioner_id'] as $j => $comId) {
            $project->commissioners()->attach($comId, [
                'commissioner_commission' => $validatedData['commissioner_commission'][$j],
            ]);
        }
    
        // Crear transferencia
        Transfer::create([
            'transfer_code' => $generatedCode,
            'transfer_bank' => $validatedData['transfer_bank'],
            'investor_id' => $validatedData['investor_id'][0], // Asumiendo que la transferencia está relacionada con el primer inversionista
            'transfer_date' => $validatedData['transfer_date'],
            'transfer_amount' => $validatedData['transfer_amount'],
            'transfer_comment' => $validatedData['transfer_comment'],
        ]);
    
        return redirect()->route('project.index')->with('success', 'Proyecto, pagaré y transferencia creados de manera exitosa.');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $investors = $project->investors;
        $commissioners = $project->commissioners;
        return view('modules.projects.show', compact('project', 'investors', 'commissioners'));
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
