<?php

namespace App\Http\Controllers;

use App\Http\Requests\Moneylender\StoreRequest;
use App\Http\Requests\Moneylender\UpdateRequest;
use App\Models\Moneylender;
use App\Models\CommissionAgent;
use App\Models\Project;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MoneylenderController extends Controller
{
    public function index()
    {
        // Iniciar el temporizador
        $startTime = microtime(true);
    
        // Tiempo de caché en minutos
        $cacheTime = 60; // 1 hora
    
        $moneylenders = Cache::remember('moneylenders', $cacheTime, function () {
            return Moneylender::get();
        });
    
        $total_project_investment = Cache::remember('total_project_investment', $cacheTime, function () {
            return Project::where('project_status', 1)->sum('project_investment');
        });
    
        $total_project_investment_terminated = Cache::remember('total_project_investment_terminated', $cacheTime, function () {
            return Project::where('project_status', 0)->sum('project_investment');
        });
    
        $total_commissioner_commission_payment = Cache::remember('total_commissioner_commission_payment', $cacheTime, function () {
            return DB::table('promissory_note_commissioners')
                ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
                ->sum('promissoryNoteCommissioner_amount');
        });
        
        $total_investor_profit_payment = Cache::remember('total_investor_profit_payment', $cacheTime, function () {
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
        
        // Calcular el tiempo de carga
        $loadTime = microtime(true) - $startTime;

        return view('modules.moneylenders.index', compact(
            'moneylenders',
            'total_project_investment',
            'total_project_investment_terminated',
            'total_commissioner_commission_payment',
            'total_investor_profit_payment',
            'total_investor_profit_paid',
            'total_commissioner_commission_paid',
            'loadTime'
        ));
    }

    public function store(StoreRequest $request)
    {
        Moneylender::create($request->all());
        return redirect()->route('moneylender.index')->with('success', 'Prestamista creado exitosamente.');
    }


    public function create()
    {
        //
    }

    public function show(Moneylender $moneylender)
    {
        //
    }

    public function edit($id)
    {
        $moneylender = Moneylender::findOrFail($id);
        return view('modules.moneylenders.index', compact('moneylender'));
    }

    public function update(UpdateRequest $request, Moneylender $moneylender)
    {
        $moneylender->update($request->all());
        return redirect()->route("moneylender.index")->with("success", "Prestamista actualizado exitosamente.");
    }

    public function destroy($id)
    {
        $moneylender = Moneylender::findOrFail($id);
        $moneylender->delete();
    
        return redirect()->route('moneylender.index')->with('success', 'Prestamista eliminado exitosamente.');
    }
}
