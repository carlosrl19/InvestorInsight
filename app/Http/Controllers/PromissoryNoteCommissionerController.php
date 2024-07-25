<?php

namespace App\Http\Controllers;

use App\Models\PromissoryNoteCommissioner;
use App\Models\Project;
use App\Models\CommissionAgent;

use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;

use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PromissoryNoteCommissionerController extends Controller
{
    public function index()
    {
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        $promissoryNotesCommissioner = Cache::remember('promissory_notes_commissioner', $cacheTime, function () {
            return PromissoryNoteCommissioner::where('commissioner_id', '!=', '1')->get();
        });
    
        $commissioners = Cache::remember('commissioners', $cacheTime, function () {
            return CommissionAgent::get();
        });
    
        $total_project_investment = Cache::remember('total_project_investment_active', $cacheTime, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });
    
        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', $cacheTime, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });
    
        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment_active', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });
    
        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment_active', $cacheTime, function () {
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
    
        return view('modules.promissory_note_commissioner.index', compact(
            'promissoryNotesCommissioner',
            'total_project_investment',
            'total_project_investment_terminated',
            'commissioners',
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid'
        ));
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

        // Obtener el monto del pagaré con centavos
        $monto = $promissoryNoteCommissioner->promissoryNoteCommissioner_amount;
    
        // Separar la parte entera y la parte decimal
        $parteEntera = floor($monto);
        $parteCentavos = round(($monto - $parteEntera) * 100);
           
        // Formateador de números a letras
        $formatter = new NumeroALetras();
        $amountLetras = $formatter->toWords($parteEntera);

        // Agregar la parte de los centavos a la cadena de letras
        if ($parteCentavos > 0) {
            $amountLetras .= " con $parteCentavos/100 CENTAVOS";
        }
           
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