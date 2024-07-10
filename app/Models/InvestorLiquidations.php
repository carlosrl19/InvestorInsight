<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorLiquidations extends Model
{
    protected $fillable = [
        'investor_id',
        'liquidation_code',
        'investor_liquidation_amount',
        'investor_liquidation_date',
        'liquidation_payment_comment',
        'liquidation_payment_imgs',
        'liquidation_payment_mode', // Modo de pago utilizado para pagarle la liquidación la inversionista
        'liquidation_payment_amount' // Cantidad pagada con el método de pago utilizado
    ];

    public function investor(){
        return $this->belongsTo(Investor::class, 'investor_id', 'id');
    }
}
