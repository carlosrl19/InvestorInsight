<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('investor_name');
            $table->string('investor_dni');
            $table->string('investor_phone');
            $table->decimal('investor_balance', 12,2); // max = 999,999,999.99
            $table->unsignedInteger('investor_reference_id')->nullable();
            $table->boolean('investor_status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
