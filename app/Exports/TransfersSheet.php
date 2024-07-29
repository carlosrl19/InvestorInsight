<?php 

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Transfer;

class TransfersSheet implements FromView
{
    public function view(): View
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $transfers = Transfer::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('transfer_bank', '!=', 'FONDOS')
            ->get();

        $totalTransferAmount = Transfer::where('transfer_bank', '!=', 'FONDOS')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('transfer_amount');

        return view('modules.dashboard._transfers_report', [
            'transfers' => $transfers,
            'totalTransferAmount' => $totalTransferAmount,
        ]);
    }
}
