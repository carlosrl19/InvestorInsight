<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromissoryNote\StoreRequest; 
use App\Models\PromissoryNote;
use App\Models\Investor;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Str;

class PromissoryNoteController extends Controller
{
    public function index()
    {
        $promissoryNotes = PromissoryNote::get();
        $investors = Investor::get();
        $promissoryCode = strtoupper(Str::random(12)); // Promissory note random code

        return view("modules.promissory_note.index", compact("promissoryNotes", "investors", "promissoryCode"));
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
        $fechaActual = Carbon::now()->setTimezone('America/Costa_Rica');
        $dia = $fechaActual->format('d');
        $mes = $fechaActual->translatedFormat('F'); // 'F' para nombre completo del mes
        $anio = $fechaActual->format('Y');
    
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
    
        // Devolver el PDF en línea
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Pagaré.pdf"');
    }
}
