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
            $table->string('loan_code');
            $table->unsignedBigInteger('moneylender_id');
            $table->foreign('moneylender_id')->references('id')->on('moneylenders')->onDelete('cascade');
            $table->unsignedBigInteger('commissioner_id');
            $table->foreign('commissioner_id')->references('id')->on('commission_agents')->onDelete('cascade');
            $table->date('loan_emission_date');
            $table->date('loan_first_paydate');
            $table->decimal('loan_amount', 10,2);
            $table->integer('loan_tax');
            $table->integer('loan_quotas');
            $table->decimal('loan_quota_amount', 10,2);
            $table->decimal('loan_total_amount', 10,2);
            $table->string('loan_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moneylender_loans');
    }
};
