<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('investor_name');
            $table->string('investor_dni');
            $table->string('investor_phone');
            $table->decimal('investor_balance', 12,2); // max = 999,999,999.99
            $table->string('investor_reference');
            $table->boolean('investor_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
