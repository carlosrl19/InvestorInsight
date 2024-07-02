<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investor_liquidations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id');
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->decimal('investor_liquidation_amount',10,2);
            $table->dateTime('investor_liquidation_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_liquidations');
    }
};
