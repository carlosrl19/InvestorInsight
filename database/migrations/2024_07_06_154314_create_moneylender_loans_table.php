<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('moneylender_loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moneylender_id');
            $table->foreign('moneylender_id')->references('id')->on('moneylenders')->onDelete('cascade');
            $table->string('loan_invoice_code');
            $table->decimal('loan_amount',10,2);
            $table->dateTime('loan_date');
            $table->date('loan_paydate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moneylender_loans');
    }
};
