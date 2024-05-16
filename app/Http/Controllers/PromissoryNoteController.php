<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromissoryNote\StoreRequest;

use App\Models\PromissoryNote;
use App\Models\Investor;

class PromissoryNoteController extends Controller
{
    public function index()
    {
        $promissoryNotes = PromissoryNote::get();
        $investors = Investor::get();

        return view("modules.promissory_note.index", compact("promissoryNotes","investors"));
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

    public function show(PromissoryNote $promissoryNote)
    {
        //
    }
}
