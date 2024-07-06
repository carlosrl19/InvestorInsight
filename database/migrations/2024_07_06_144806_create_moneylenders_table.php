<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moneylenders', function (Blueprint $table) {
            $table->id();
            $table->string('moneylender_name');
            $table->string('moneylender_dni');
            $table->string('moneylender_phone');
            $table->string('moneylender_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moneylenders');
    }
};
