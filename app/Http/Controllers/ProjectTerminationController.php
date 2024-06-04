<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Dompdf\Options;
use Dompdf\Dompdf;

class ProjectTerminationController extends Controller
{
    public function index(){
        $projects = Project::where('project_status', 0)->with('investors')->get();

        return view('modules.terminations.index', compact('projects'));
    }

    public function showTermination($id) {
        // Cargar el proyecto junto con los inversores y comisionados
        $project = Project::with(['investors', 'commissioners'])->findOrFail($id);

        $endDate = $project->project_end_date;
        $endDay = Carbon::parse($endDate)->format('d');
        $endMonth = Carbon::parse($endDate)->format('m');
        $endYear = Carbon::parse($endDate)->format('Y');

        $completionDate = $project->project_completion_work_date;
        $day = Carbon::parse($completionDate)->format('d');
        $month = Carbon::parse($completionDate)->format('m');
        $year = Carbon::parse($completionDate)->format('Y');

            
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
        
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);

        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.terminations._termination_report', compact('project', 'endDay', 'endMonth', 'endYear', 'day', 'month', 'year')));

        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');

        // Renderizar el PDF
        $pdf->render();
    
        // Devolver el PDF en línea
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Finiquito.pdf"');
    }
}
