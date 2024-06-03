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
use App\Exports\CustomExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('investors')->get();
        $investors = Investor::get();
        $commissioners = CommissionAgent::get();
        $generatedCode = strtoupper(Str::random(12)); // Random code

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
                    'investor_final_profit' => $validatedData['investor_final_profit'][$i],
                ]);
    
                // Crear pagaré para cada inversionista del proyecto
                $promissoryNoteCode = $generatedCode;
    
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
            $promissoryNoteCode = $generatedCode;
    
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
            'investor_id' => is_array($validatedData['investor_id']) ? $validatedData['investor_id'][0] : $validatedData['investor_id'],
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

    public function export($id)
    {
        return Excel::download(new CustomExport($id), 'Excel de proyecto.xlsx');
    }

    public function finishProject(Request $request, Project $project)
    {
        // Validar los datos recibidos
        $request->validate([
            'project_completion_work_date' => 'required|date',
            'project_proof_transfer_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    
            // Project start date messages
            'project_completion_work_date.date' => 'La fecha final de cierre del proyecto debe ser una fecha válida.',
            'project_completion_work_date.after_or_equal' => 'La fecha final de cierre del proyecto no puede ser anterior a la fecha de inicio del mismo.',
    
            // Project proof transfer img messages
            'project_proof_transfer_img.after_or_equal' => 'El comprobante de pago de transferencia del proyecto debe ser una imagen válida.',
        ]);
    
        // Procesar la imagen
        if ($request->hasFile('project_proof_transfer_img')) {
            $imageName = time().'.'.$request->project_proof_transfer_img->extension();
            $request->project_proof_transfer_img->move(public_path('images'), $imageName);
            $project->project_proof_transfer_img = $imageName;
        } else {
            $project->project_proof_transfer_img = 'no-image.png';
        }
    
        // Actualizar el estado del proyecto
        $project->project_status = '0';
        $project->project_completion_work_date = $request->project_completion_work_date;
        $project->save();
    
        // Sumar el investor_final_investment al investor_balance de cada inversor asociado al proyecto
        foreach ($project->investors as $investor) {
            $investor->investor_balance += $investor->pivot->investor_final_profit;
            $investor->save();
        }
    
        // Guardar el ID del proyecto en la sesión para la generación del PDF
        // Esto funciona con JS en el project.index que detecta el project->id para el PDF y lo hace descargar automáticamente
        session()->flash('project_id', $project->id);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('project.index', compact('project'))->with('success', 'Proyecto finalizado exitosamente.');
    }
    
    public function downloadTerminationReport($id)
    {
        $project = Project::findOrFail($id);
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
        
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.projects._termination_report', compact('project')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
    
        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Finiquito.pdf');
    }
    

    public function closeProject(Project $project)
    {
        $project->project_status = '2';
        $project->save();

        return redirect()->route('project.index')->with('success', 'Proyecto cerrado correctamente.');
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
