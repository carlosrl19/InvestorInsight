<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PaymentInvestor;
use App\Models\PromissoryNote;
use App\Models\PromissoryNoteCommissioner;
use App\Models\Investor;
use App\Models\CommissionAgent;
use Carbon\Carbon;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Str;

class ProjectTerminationController extends Controller
{
    public function index(){
        $projects = Project::where('project_status', 0)->with('investors')->get();
        $total_investor_balance = Investor::sum('investor_balance');
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        $payments = PaymentInvestor::with(['promissoryNoteInvestor.investor'])->get();
        $promissoryNoteInvestors = PromissoryNote::get();
        $promissoryNoteCommissioners = PromissoryNoteCommissioner::get();
        $generatedCode = strtoupper(Str::random(12)); // Random code
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        return view('modules.terminations.index', compact('projects', 'total_project_investment', 'total_investor_balance', 'total_commissioner_balance', 'payments', 'promissoryNoteInvestors', 'promissoryNoteCommissioners', 'generatedCode', 'todayDate'));
    }

    public function showTermination($id) {
        // Cargar el proyecto junto con los inversores y comisionados
        $project = Project::with(['investors', 'commissioners'])->findOrFail($id);

        $endDate = $project->project_end_date;
        $endDay = Carbon::parse($endDate)->format('d');
        $endMonth = Carbon::parse($endDate)->format('m');
        $endYear = Carbon::parse($endDate)->format('Y');

        $startDate = $project->project_start_date;
        $day = Carbon::parse($startDate)->format('d');
        $month = Carbon::parse($startDate)->format('m');
        $year = Carbon::parse($startDate)->format('Y');

            
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
            ->header('Content-Disposition', 'inline; filename="PDF FINIQUITO.pdf"');
    }
}
