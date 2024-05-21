<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commission_agents', function (Blueprint $table) {
            $table->id();
            $table->string('commissioner_name');
            $table->string('commissioner_dni');
            $table->string('commissioner_phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_agents');
    }
};
