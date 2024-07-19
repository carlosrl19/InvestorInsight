<?php

namespace App\Http\Controllers;

use App\Http\Requests\Moneylender\StoreRequest;
use App\Http\Requests\Moneylender\UpdateRequest;
use App\Models\Moneylender;
use App\Models\Investor;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class MoneylenderController extends Controller
{
    public function index()
    {
        $moneylenders = Moneylender::get();
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

        return view('modules.moneylenders.index', compact(
            'moneylenders',
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
        //
    }

    public function store(StoreRequest $request)
    {
        Moneylender::create($request->all());
        return redirect()->route('moneylender.index')->with('success', 'Prestamista creado exitosamente.');
    }

    public function show($id)
    {
        $moneylender = Moneylender::findOrFail($id);

        $total_project_investment = Project::where('project_status', 1)->sum('project_investment');
        $total_commissioner_commission_payment = DB::table('promissory_note_commissioners')
        ->where('promissory_note_commissioners.promissoryNoteCommissioner_status', 1)
        ->sum('promissoryNoteCommissioner_amount');


        return view('modules.moneylenders.show', compact('moneylender', 'total_project_investment',  'total_commissioner_commission_payment'));
    }

    public function edit(Moneylender $moneylender)
    {
        //
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
