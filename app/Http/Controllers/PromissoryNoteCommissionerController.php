<?php

namespace App\Http\Controllers;

use App\Models\PromissoryNoteCommissioner;
use App\Models\Investor;
use App\Models\Project;
use App\Models\CommissionAgent;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Luecano\NumeroALetras\NumeroALetras;

class PromissoryNoteCommissionerController extends Controller
{
    public function index()
    {
        $promissoryNotesCommissioner = PromissoryNoteCommissioner::where('commissioner_id', '!=', '1')->get();
        $commissioners = CommissionAgent::get();

        $total_investor_balance = Investor::sum('investor_balance');
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');

        return view('modules.promissory_note_commissioner.index', compact('promissoryNotesCommissioner', 'total_project_investment', 'commissioners', 'total_investor_balance', 'total_commissioner_balance'));
    }
    
    public function showReport($id) {
        $promissoryNoteCommissioner = PromissoryNoteCommissioner::findOrFail($id);

        // Configurar el locale en Carbon
        Carbon::setLocale('es');

        // Obtener la fecha actual en español
        $fechaFinal = Carbon::parse($promissoryNoteCommissioner->promissoryNoteCommissioner_emission_date); 

        $dia = $fechaFinal->format('d');
        $mes = $fechaFinal->translatedFormat('F'); // 'F' para nombre completo del mes
        $anio = $fechaFinal->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
        
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);

        // Formateador de números a letras
        $formatter = new NumeroALetras();
        $amountLetras = $formatter->toWords($promissoryNoteCommissioner->promissoryNoteCommissioner_amount);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.promissory_note_commissioner._report', compact('promissoryNoteCommissioner', 'amountLetras', 'dia', 'mes', 'anio')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
    
        // Devolver el PDF en línea
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="PDF PAGARÉ COMISIONISTA.pdf"');
    }
}