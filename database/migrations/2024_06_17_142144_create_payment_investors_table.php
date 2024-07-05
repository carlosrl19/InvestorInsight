<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_investors', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code');
            $table->decimal('payment_amount', 10,2);
            $table->date('payment_date');
            $table->unsignedBigInteger('investor_id');
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->unsignedBigInteger('promissoryNote_id');
            $table->foreign('promissoryNote_id')->references('id')->on('promissory_notes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_investors');
    }
};
