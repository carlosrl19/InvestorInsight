<?php

namespace App\Http\Controllers;

use App\Models\CommissionAgent;
use Illuminate\Http\Request;
use App\Http\Requests\Project\StoreRequest;
use App\Models\Investor;
use App\Models\InvestorFunds;
use App\Models\Project;
use App\Models\Transfer;
use App\Models\PromissoryNote;
use App\Models\PromissoryNoteCommissioner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Exports\CustomExport;
use App\Exports\ActiveProjectsExport;
use App\Exports\ActiveInvestorProjectExport;
use App\Models\PaymentCommissioner;
use App\Models\PaymentInvestor;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /* --------------------------
        PROJECT'S INDEX FUNCTIONS
    ----------------------------- */
    public function index()
    {
        $projects = Project::where('project_status', 1)->with('investors')->get();
        $activeProjectsCount = Project::where('project_status', 1)->count();
        
        $investorsWithActivedProjects = Investor::whereHas('projects', function($query) {
            $query->where('project_status', 1);
        })->get();
        
        $availableInvestors = Investor::where('investor_status', 1)->get();
        $investors = Investor::orderBy('investor_name')->get();

        $promissoryNote = PromissoryNote::get();
        $commissioners = CommissionAgent::get();
        $generatedCode = strtoupper(Str::random(12)); // Random code
        $total_investor_balance = Investor::sum('investor_balance');
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
        
        // Calcular días restantes para cada proyecto
        foreach ($projects as $project) {
            $daysRemaining = now()->diffInDays($project->project_end_date, false) + 2;
            if ($daysRemaining <= 0) {
                $project->days_remaining = '0';
            } else {
                $project->days_remaining = $daysRemaining;
            }
        }
        
        return view('modules.projects.index', compact('projects', 'activeProjectsCount', 'total_project_investment', 'investorsWithActivedProjects', 'investors', 'availableInvestors', 'commissioners', 'promissoryNote', 'generatedCode', 'total_investor_balance', 'total_commissioner_commission_payment', 'todayDate',));
    }
    
    public function indexClosed()
    {
        $projects = Project::where('project_status', 2)->with('investors')->get();
        $investors = Investor::orderBy('investor_name')->get();
        $total_investor_balance = Investor::sum('investor_balance');
        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
            ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
            ->sum('promissoryNoteCommissioner_amount');

        return view('modules.projects_closed.index', compact('projects', 'investors', 'total_investor_balance', 'total_project_investment', 'total_commissioner_commission_payment'));
    }
    // END INDEX FUNCTIONS

    /* --------------------------
        PROJECT'S STORE FUNCTIONS
    ----------------------------- */
    public function store(StoreRequest $request)
    {
        $generatedCode = strtoupper(Str::random(12));
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
    
        // Validar los datos del formulario
        $validatedData = $request->validated();
    
        // Verificar la condición del banco de transferencia antes de crear el proyecto
        if ($validatedData['transfer_bank'] == 'FONDOS') {
            // Encontrar el inversionista
            $investorId = is_array($validatedData['investor_id']) ? $validatedData['investor_id'][0] : $validatedData['investor_id'];
            $investor = Investor::find($investorId);
    
            // Verificar si el monto de la transferencia es mayor que el balance del inversionista
            if ($validatedData['transfer_amount'] > $investor->investor_balance) {
                return redirect()->back()->withErrors(['transfer_amount' => 'El monto de transferencia no puede ser mayor que el fondo del inversionista.'])->withInput();
            }
    
            // Restar el transfer_amount del investor_balance_history
            $validatedData['investor_balance_history'] -= $validatedData['transfer_amount'];
        } else {
            return redirect()->back()->withErrors(['transfer_bank' => 'Solamente se permite utilizar los fondos del inversionista para realizar una inversión.'])->withInput();
        }
    
        // Verificar que el investor_profit no sea mayor que el investor_investment
        if (is_array($validatedData['investor_profit'])) {
            foreach ($validatedData['investor_profit'] as $i => $profit) {
                if ($profit > $validatedData['investor_investment'][$i]) {
                    return redirect()->back()->withErrors(['investor_profit' => 'La ganancia del inversionista no puede ser mayor que la inversión.'])->withInput();
                }
            }
        } else {
            if ($validatedData['investor_profit'] > $validatedData['investor_investment']) {
                return redirect()->back()->withErrors(['investor_profit' => 'La ganancia del inversionista no puede ser mayor que la inversión.'])->withInput();
            }
        }
    
        // Crear proyecto
        $project = Project::create([
            'project_name' => $validatedData['project_name'],
            'project_code' => $generatedCode,
            'project_start_date' => $validatedData['project_start_date'],
            'project_end_date' => $validatedData['project_end_date'],
            'project_work_days' => $validatedData['project_work_days'],
            'project_investment' => $validatedData['project_investment'],
            'project_status' => $validatedData['project_status'],
            'project_comment' => $validatedData['project_comment'],
            'investor_balance_history' => $validatedData['investor_balance_history'],
        ]);
    
            // Asociar inversionistas con el proyecto
            if (is_array($validatedData['investor_id'])) {
                $i = 0;
                foreach ($validatedData['investor_id'] as $invId) {
                    $investor_investment = $validatedData['investor_investment'][$i];
                    
                    // Establecer investor_investment en 0.00 para el segundo inversionista
                    if ($i == 1) {
                        $investor_investment = 0.00;
                    }
                    
                    $project->investors()->attach($invId, [
                        'investor_investment' => $investor_investment,
                        'investor_profit' => $validatedData['investor_profit'][$i],
                        'investor_final_profit' => $validatedData['investor_final_profit'][$i],
                    ]);

                    // Crear pagaré para cada inversionista del proyecto
                    $promissoryNoteCode = $generatedCode;

                    PromissoryNote::create([
                        'investor_id' => $invId,
                        'promissoryNote_emission_date' => $todayDate,
                        'promissoryNote_final_date' => $project->project_end_date,
                        'promissoryNote_amount' => $investor_investment + $validatedData['investor_final_profit'][$i],
                        'promissoryNote_code' => $promissoryNoteCode,
                        'promissoryNote_status' => 1,
                    ]);
                    
                    $i++;
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
                'promissoryNote_emission_date' => $todayDate,
                'promissoryNote_final_date' => $project->project_end_date,
                'promissoryNote_amount' => $validatedData['investor_investment'] + $validatedData['investor_final_profit'],
                'promissoryNote_code' => $promissoryNoteCode,
                'promissoryNote_status' => 1,
            ]);
        }
    
        // Asociar comisionistas con el proyecto
        foreach ($validatedData['commissioner_id'] as $j => $comId) {
            $project->commissioners()->attach($comId, [
                'commissioner_commission' => $validatedData['commissioner_commission'][$j],
            ]);
    
            $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');
    
            PromissoryNoteCommissioner::create([
                'commissioner_id' => $comId,
                'promissoryNoteCommissioner_emission_date' => $todayDate,
                'promissoryNoteCommissioner_final_date' => $project->project_end_date,
                'promissoryNoteCommissioner_amount' => $validatedData['commissioner_commission'][$j],
                'promissoryNoteCommissioner_code' => $promissoryNoteCode,
                'promissoryNoteCommissioner_status' => 1,
            ]);
        }
    
        // Crear transferencia
        $transfer = Transfer::create([
            'transfer_code' => $generatedCode,
            'transfer_bank' => $validatedData['transfer_bank'],
            'investor_id' => is_array($validatedData['investor_id']) ? $validatedData['investor_id'][0] : $validatedData['investor_id'],
            'transfer_date' => $todayDate,
            'transfer_amount' => $validatedData['transfer_amount'],
            'transfer_comment' => $validatedData['transfer_comment'],
        ]);
    
        // Ajustar el balance del inversionista según el banco de transferencia
        $investor = Investor::find($transfer->investor_id);
    
        if ($validatedData['transfer_bank'] == 'FONDOS') {
            $investor->investor_balance -= $validatedData['transfer_amount'];

            $investorFunds = new InvestorFunds();
            $investorFunds->investor_id = $investor->id;
            $investorFunds->investor_change_date = now();
            $investorFunds->investor_old_funds = $investor->investor_balance + $validatedData['transfer_amount'];
            $investorFunds->investor_new_funds = $investor->investor_balance;
            $investorFunds->investor_new_funds_comment = 'FONDO A CAPITAL DE ' . $validatedData['project_name'] . ' - CODIGO #' . $generatedCode . '.';
            $investorFunds->save();
        }
    
        $investor->save();
    
        return redirect()->route('project.index')->with('success', 'Proyecto creado de manera exitosa.');
    }
    // END PROJECT'S STORE FUNCTIONS
    
    /* --------------------------
        EXPORTATIONS FUNCTIONS
    ----------------------------- */
    public function export($id)
    {
        $project = Project::findOrFail($id);
        $projectName = $project->project_name;

        if($project->project_status == 1)
            return Excel::download(new CustomExport($id), $projectName . ' - EXCEL TRABAJANDO.xlsx');
        
        else if($project->project_status == 0)
            return Excel::download(new CustomExport($id), $projectName . ' - EXCEL FINALIZADO.xlsx');
    }

    public function exportActiveProjects()
    {
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->locale('es')->translatedFormat('d F Y'); // Mes con nombre completo en español
        $todayDate = str_replace(Carbon::now()->translatedFormat('F'), strtoupper(Carbon::now()->translatedFormat('F')), $todayDate); // Uppercase para el nombre del mes
    
        return Excel::download(new ActiveProjectsExport, 'PROYECTOS ACTIVOS ' . $todayDate . ' - EXCEL.xlsx');
    }

    public function exportActiveInvestorProjects($investorId)
    {   
        $investor = Investor::findOrFail($investorId);
        $investorName = $investor->investor_name;

        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->locale('es')->translatedFormat('d F Y'); // Mes con nombre completo en español
        $todayDate = str_replace(Carbon::now()->translatedFormat('F'), strtoupper(Carbon::now()->translatedFormat('F')), $todayDate); // Uppercase para el nombre del mes

        return Excel::download(new ActiveInvestorProjectExport($investorId), 'PROYECTOS ACTIVOS (' . $todayDate . ') - '. $investorName . '.xlsx');
    }
    // END EXPORTATION FUNCTIONS

    /* --------------------------
        PROJECT'S CHANGE STATE FUNCTIONS
    ----------------------------- */
    public function finishProject(Request $request, Project $project)
    {
        // Validar los datos recibidos
        $request->validate([
            'project_proof_transfer_img' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
    
            // Project proof transfer img messages
            'project_proof_transfer_img.image' => 'El comprobante de pago de transferencia del proyecto debe ser una imagen válida.',
            'project_proof_transfer_img.mimes' => 'El formato de imagen debe ser jpeg, png, jpg, svg.',
        ]);
    
        // Procesar la imagen
        if ($request->hasFile('project_proof_transfer_img')) {
            $imageName = time() . '.' . $request->project_proof_transfer_img->extension();
            $request->project_proof_transfer_img->move(public_path('images/transfers'), $imageName);
            $project->project_proof_transfer_img = $imageName;
        } else {
            $project->project_proof_transfer_img = 'no-image.png';
        }
    
        // Actualizar el estado del proyecto
        $project->project_status = '0';
        $project->save();
    
        // Sumar el investor_final_investment al investor_balance de cada inversor asociado al proyecto
        foreach ($project->investors as $investor) {
            $investor->investor_balance += $investor->pivot->investor_final_profit + $investor->pivot->investor_investment;
            $investor->save();
    
            // Guardar el registro en InvestorFunds
            $investorFunds = new InvestorFunds();
            $investorFunds->investor_id = $investor->id;
            $investorFunds->investor_change_date = now();
            $investorFunds->investor_old_funds = $investor->investor_balance - ($investor->pivot->investor_final_profit + $investor->pivot->investor_investment);
            $investorFunds->investor_new_funds = $investor->investor_balance;
            $investorFunds->investor_new_funds_comment = 'GANANCIA + CAPITAL A FONDO POR ' . $project->project_name . ' - CODIGO #' . $project->project_code . '.';
            $investorFunds->save();

            // Crear registro de pago para cada inversionista (payment_investors)
            $investorPayment = new PaymentInvestor();
            $investorPayment->investor_id = $investor->id;
            $promissoryNoteId = PromissoryNote::where('promissoryNote_code', $project->project_code)->value('id');
            $investorPayment->promissoryNote_id = $promissoryNoteId;
            $investorPayment->project_id = $project->id;
            $investorPayment->payment_code = $project->project_code;
            $investorPayment->payment_amount = ($investor->pivot->investor_final_profit + $investor->pivot->investor_investment);
            $investorPayment->payment_date = now();
            $investorPayment->save();
        }
    
        // Sumar el commissioner_commission al commissioner_balance de cada comisionista asociado al proyecto
        foreach ($project->commissioners as $commissioner) {
            $commissioner->commissioner_balance += ($commissioner->pivot->commissioner_commission);
            $commissioner->save();

            // Crear registro de pago para cada comisionista (payment_commissioner)
            $commissionerPayment = new PaymentCommissioner();
            $commissionerPayment->commissioner_id = $commissioner->id;
            $promissoryNoteId = PromissoryNote::where('promissoryNote_code', $project->project_code)->value('id');
            $commissionerPayment->promissoryNote_id = $promissoryNoteId;
            $commissionerPayment->payment_code = $project->project_code;
            $commissionerPayment->payment_amount = $commissioner->pivot->commissioner_commission;
            $commissionerPayment->payment_date = now();
            $commissionerPayment->save();
        }

        // Cambiar estado del pagaré del inversionista
        DB::table('promissory_notes')
            ->where('promissoryNote_code', $project->project_code)
            ->update(['promissoryNote_status' => 0]);

        // Cambiar estado del pagaré del comisionista
        DB::table('promissory_note_commissioners')
            ->where('promissoryNoteCommissioner_code', $project->project_code)
            ->update(['promissoryNoteCommissioner_status' => 0]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('project.index', compact('project'))->with('success', 'Proyecto finalizado exitosamente.');
    }

    public function closeProject(Request $request, Project $project)
    {
        // Validar los datos recibidos
        $request->validate([
            'project_close_comment' => 'required|string|min:3|max:255',
        ], [
            // Project description messages
            'project_close_comment.required' => 'El motivo de cierre del proyecto es obligatorio.',
            'project_close_comment.string' => 'El motivo de cierre del proyecto solo debe contener letras, números y/o símbolos.',
            'project_close_comment.min' => 'El motivo de cierre del proyecto debe tener al menos 3 caracteres.',
            'project_close_comment.max' => 'El motivo de cierre del proyecto no puede tener más de 255 caracteres.',
        ]);

        $project->project_status = '2';
        $project->project_close_comment = $request->input('project_close_comment');
        $project->save();

        return redirect()->route('project.index')->with('success', 'Proyecto cerrado correctamente.');
    }
    // END PROJECT'S CHANGE STATE FUNCTIONS

    /* --------------------------
        PROJECT'S SHOW & REPORT FUNCTIONS
    ----------------------------- */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $transfer = Transfer::findOrFail($id);
        $investors = $project->investors;
        $commissioners = $project->commissioners;
        
        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');

        return view('modules.projects.show', compact('project', 'transfer', 'investors', 'commissioners', 'total_investor_balance', 'total_commissioner_commission_payment'));
    }

    public function showTermination($id)
    {
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

        // Devolver el PDF para descarga forzada
        return response()->streamDownload(function () use ($pdf, $project) {
            echo $pdf->output();
        }, $project->project_name . ' - FINIQUITO' . '.pdf');
    }
    // END PROJECT'S SHOW & REPORT FUNCTIONS
}