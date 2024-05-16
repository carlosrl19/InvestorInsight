<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('promissory_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('investor_id');
            $table->decimal('promissoryNote_amount', 10,2);
            $table->date('promissoryNote_emission_date');
            $table->date('promissoryNote_final_date');
            $table->string('promissoryNote_code');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promissory_notes');
    }
};
