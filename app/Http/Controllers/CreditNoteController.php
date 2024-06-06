<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;      
use App\Models\CreditNote;
use App\Http\Requests\CreditNote\StoreRequest;
use App\Models\Investor;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CreditNoteController extends Controller
{
    public function index()
    {
        $creditNotes = CreditNote::get();
        $investors = Investor::get();
        $creditNoteCode = strtoupper(Str::random(12)); // Credit note random code
        $creditNoteDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        return view('modules.credit_note.index', compact('creditNotes', 'investors', 'creditNoteCode', 'creditNoteDate'));
    }

    public function create()
    {
        return view('modules.credit_note._create');
    }

    public function showReport($id) {
        $creditNote = CreditNote::findOrFail($id);

        // Configurar el locale en Carbon
        Carbon::setLocale('es');

        // Obtener la fecha actual en español
        $fecha = Carbon::now()->setTimezone('America/Costa_Rica');
        $dia = $fecha->format('d');
        $mes = $fecha->translatedFormat('F'); // 'F' para nombre completo del mes
        $anio = $fecha->format('Y');
    
        // Configuración de opciones para Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        // Opcion que habilita la carga de imagenes
        $options->set('chroot', realpath(''));
        
        // Crear instancia de Dompdf con las opciones configuradas
        $pdf = new Dompdf($options);
    
        // Cargar el contenido de la vista en Dompdf
        $pdf->loadHtml(view('modules.credit_note._report', compact('creditNote', 'dia', 'mes', 'anio')));
    
        // Establecer el tamaño y la orientación del papel
        $pdf->setPaper('A4', 'portrait');
    
        // Renderizar el PDF
        $pdf->render();
    
        // Devolver el PDF en línea
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Nota crédito.pdf"');
    }
    
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
    
        try {
            // Encuentra al inversionista por su ID
            $investor = Investor::findOrFail($request->investor_id);
            $creditNoteCode = strtoupper(Str::random(12)); // Credit note random code
            $creditNoteDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

            // Verifica si el monto de la nota de crédito es mayor que el saldo del inversionista
            if ($request->creditNote_amount > $investor->investor_balance) {
                return redirect()->back()->withErrors(['creditNote_amount' => 'El monto de la nota de crédito no puede ser mayor que el fondo del inversionista (Lps. '. $investor->investor_balance. ').'])->withInput();
            }
            
            // Crea la nueva nota crédito
            $transfer = CreditNote::create([
                'creditNote_date' => $creditNoteDate,
                'investor_id' => $request->investor_id,
                'creditNote_amount' => $request->creditNote_amount,
                'creditNote_code' => $creditNoteCode,
                'creditNote_description' => $request->creditNote_description,
            ]);
    
            // Actualiza el saldo del inversionista restando el monto de la nota crédito
            $newBalance = $investor->investor_balance - $request->creditNote_amount;
            $investor->update(['investor_balance' => $newBalance]);
    
            DB::commit();
    
            return redirect()->route('credit_note.index')->with('success', 'Nota crédito creada exitosamente.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Get errors
            //dd($e->getMessage());
            
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error inesperado al intentar guardar la transferencia. Si el problema persiste, contacte al servicio técnico.'])->withInput();
        }
    }
}
