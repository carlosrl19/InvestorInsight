<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_commissioners', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code');
            $table->decimal('payment_amount', 10,2);
            $table->date('payment_date');
            $table->unsignedInteger('promissoryNoteCommissioner_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_commissioners');
    }
};
