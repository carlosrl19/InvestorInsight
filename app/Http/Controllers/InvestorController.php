<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Investor\StoreRequest;
use App\Http\Requests\Investor\UpdateRequest;
use App\Http\Requests\InvestorFunds\StoreInverstorFundsRequest;
use Illuminate\Support\Facades\DB;
use App\Models\CommissionAgent;
use App\Models\CreditNote;
use App\Models\Investor;
use App\Models\InvestorFunds;
use App\Models\Transfer;
use Carbon\Carbon;

class InvestorController extends Controller
{
    public function index()
    {
        $investors = Investor::get();
        $investorFunds = InvestorFunds::get();
        $commissioners = CommissionAgent::get();
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');
    
        // Mapeamos los investors para obtener sus referencias
        $investors = $investors->map(function ($investor) {
            $investor->investor_reference = Investor::find($investor->investor_reference_id);
            return $investor;
        });

        return view('modules.investors.index', compact('investors', 'todayDate', 'investorFunds', 'commissioners', 'total_investor_balance', 'total_commissioner_balance'));
    }
    
    public function create()
    {
        return view('modules.investors.create');
    }
    
    public function store(StoreRequest $request)
    {    
        Investor::create($request->all());
        return redirect()->route('investor.index')->with('success', 'Inversionista creado exitosamente.');
    }

    public function show($id)
    {
        $investor = Investor::findOrFail($id);
        $transfers = Transfer::where('investor_id', $investor->id)->orderBy('transfer_date')->get();
        $creditNotes = CreditNote::where('investor_id', $investor->id)->orderBy('creditNote_date')->get();
        $total_investor_balance = Investor::sum('investor_balance');
        $total_commissioner_balance = CommissionAgent::sum('commissioner_balance');
    
        // Cargar el inversor de referencia
        $referenceInvestor = Investor::find($investor->investor_reference_id);
    
        // Combine transfers and credit notes in a single collection and order them by date
        $events = collect();
    
        foreach ($transfers as $transfer) {
            $events->push((object) [
                'date' => $transfer->transfer_date,
                'type' => 'transfer',
                'amount' => $transfer->transfer_amount,
                'description' => $transfer->transfer_description,
                'bank' => $transfer->transfer_bank,
                'original_model' => $transfer
            ]);
        }
    
        foreach ($creditNotes as $creditNote) {
            $events->push((object) [
                'date' => $creditNote->creditNote_date,
                'type' => 'creditNote',
                'amount' => -$creditNote->creditNote_amount,
                'description' => $creditNote->creditNote_description,
                'bank' => null,
                'original_model' => $creditNote
            ]);
        }
    
        $events = $events->sortBy('date');
    
        // Calculate the current balance from zero, reflecting all transactions
        $currentBalance = 0;
        foreach ($events as $event) {
            $currentBalance += $event->amount;
            $event->current_balance = $currentBalance;
        }
    
        // Separate the events into transfers and credit notes again for displaying in tables
        $transfers = $events->where('type', 'transfer')->map(function ($event) {
            $transfer = $event->original_model;
            $transfer->current_balance = $event->current_balance;
            return $transfer;
        });
    
        $creditNotes = $events->where('type', 'creditNote')->map(function ($event) {
            $creditNote = $event->original_model;
            $creditNote->current_balance = $event->current_balance;
            return $creditNote;
        });
    
        // Recuperar los proyectos activos del inversionista
        $activeProjects = DB::table('projects')
            ->join('project_investor', 'projects.id', '=', 'project_investor.project_id')
            ->where('project_investor.investor_id', $id)
            ->where('projects.project_status', 1)
            ->select('projects.project_name', 'projects.project_code', 'projects.project_investment', 'project_investor.investor_investment', 'project_investor.investor_profit', 'project_investor.investor_final_profit')
            ->get();
    
        // Recuperar los proyectos finalizados del inversionista
        $completedProjects = DB::table('projects')
            ->join('project_investor', 'projects.id', '=', 'project_investor.project_id')
            ->where('project_investor.investor_id', $id)
            ->where('projects.project_status', 0)
            ->select('projects.project_name', 'projects.project_code', 'projects.project_investment', 'project_investor.investor_investment', 'project_investor.investor_final_profit', 'project_investor.investor_profit')
            ->get();
    
        return view('modules.investors.show', compact('investor', 'transfers', 'creditNotes', 'referenceInvestor', 'activeProjects', 'completedProjects', 'total_investor_balance', 'total_commissioner_balance'));
    }

    public function edit($id)
    {
        $investor = Investor::findOrFail($id);
        return view('modules.investors.index', compact('investor'));
    }
    
    public function fund(StoreInverstorFundsRequest $request, $id)
    {
        // Encuentra el inversionista o falla si no existe
        $investor = Investor::findOrFail($id);
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d');

        // Guarda los fondos anteriores antes de actualizar
        $oldFunds = $investor->investor_balance;
    
        // Actualiza el balance del inversionista
        $investor->investor_balance = $request->input('investor_new_funds');
        $investor->save();
    
        // Obtén los datos validados y añade los campos necesarios para InvestorFunds
        $validatedData = $request->validated();
        $validatedData['investor_id'] = $investor->id;
        $validatedData['investor_change_date'] = $todayDate;
        $validatedData['investor_old_funds'] = $oldFunds;
        $validatedData['investor_new_funds'] = $investor->investor_balance;
        $validatedData['investor_new_funds_comment'] = $request->input('investor_new_funds_comment');
    
        // Crea el registro en InvestorFunds usando create
        InvestorFunds::create($validatedData);
    
        // Redirige con un mensaje de éxito
        return redirect()->route('investor.index')->with("success", "Fondo del inversionista actualizado exitosamente.");
    }

    public function update(UpdateRequest $request, Investor $investor)
    {
        $investor->update($request->all());
        return redirect()->route("investor.index")->with("success", "Inversionista actualizado exitosamente.");
    }

    public function destroy($id)
    {
        Investor::destroy($id);
        return redirect()->route('investor.index')->with('success', 'Inversionista eliminado exitosamente.');
    }
}
