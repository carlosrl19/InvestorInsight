<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromissoryNote\StoreRequest; 
use App\Models\PromissoryNote;
use App\Models\Project;
use App\Models\Investor;
use App\Models\CommissionAgent;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PromissoryNoteController extends Controller
{
    public function index()
    {
        $promissoryNotes = PromissoryNote::get();
        $investors = Investor::orderBy('investor_name')->get();
        $promissoryCode = strtoupper(Str::random(12)); // Promissory note random code
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_project_investment_terminated = Project::where('project_status', 0)->sum('project_investment');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');

        $total_investor_profit_payment = DB::table('promissory_notes')
        ->where('promissory_notes.promissoryNote_status', 1)
        ->sum('promissoryNote_amount');

        $total_investor_profit_paid = DB::table('promissory_notes')
        ->where('promissory_notes.promissoryNote_status', 0)
        ->sum('promissoryNote_amount');

        $total_commissioner_commission_paid = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 0)
        ->sum('promissoryNoteCommissioner_amount');

        return view("modules.promissory_note.index", compact(
            'promissoryNotes', 
            'investors', 
            'promissoryCode', 
            'total_project_investment', 
            'total_project_investment_terminated', 
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid'
        ));
    }
    public function create()
    {
        return view('modules.promissory_note._create');
    }

    public function store(StoreRequest $request)
    {
        PromissoryNote::create($request->all());
        return redirect()->route('promissory_note.index')->with('success', 'Pagaré creado exitosamente.');//
    }

    public function showReport($id) {
        $promissoryNote = PromissoryNote::findOrFail($id);
    
        // Configurar el locale en Carbon
        Carbon::setLocale('es');
    
        // Obtener la fecha actual en español
        $fechaFinal = Carbon::parse($promissoryNote->promissoryNote_emission_date); 
    
        $dia = $fechaFinal->format('d');
        $mes = $fechaFinal->translatedFormat('F'); // 'F' para nombre completo del mes
        $anio = $fechaFinal->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('chroot', realpath(''));
    
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Obtener el monto del pagaré con centavos
        $monto = $promissoryNote->promissoryNote_amount;
    
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
        $pdf->loadHtml(view('modules.promissory_note._report', compact('promissoryNote', 'amountLetras', 'dia', 'mes', 'anio')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
    
        // Devolver el PDF en línea
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="PDF PAGARÉ.pdf"');
    }

    public function downloadReport($id) {
        $promissoryNote = PromissoryNote::findOrFail($id);

        // Configurar el locale en Carbon
        Carbon::setLocale('es');

        // Obtener la fecha actual en español
        $fechaFinal = Carbon::parse($promissoryNote->promissoryNote_emission_date); 

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
        $amountLetras = $formatter->toWords($promissoryNote->promissoryNote_amount);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.promissory_note._report', compact('promissoryNote', 'amountLetras', 'dia', 'mes', 'anio')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();

        // Obtener el project_code a partir del promissoryNote_code
        $project = Project::where('project_code', $promissoryNote->promissoryNote_code)->first();

        // Obtener el project_name
        $project_name = $project->project_name;
    
        // Crear el nombre del archivo con el formato deseado
        $file_name = $project_name . ' - PAGARÉ.pdf';

        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf, $promissoryNote) {
            echo $pdf->output();
        }, $file_name);
    }
}
