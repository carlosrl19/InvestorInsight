<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\PromissoryNote;

class PromissoryNotesSheet implements FromView
{
    public function view(): View
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $promissory_notes = PromissoryNote::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        return view('modules.dashboard._promissory_notes_report', [
            'promissory_notes' => $promissory_notes,
        ]);
    }
}
