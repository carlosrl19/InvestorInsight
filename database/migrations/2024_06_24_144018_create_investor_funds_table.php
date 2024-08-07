<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investor_funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id');
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->dateTime('investor_change_date');
            $table->decimal('investor_old_funds',10,2);
            $table->decimal('investor_new_funds',10,2);
            $table->string('investor_new_funds_comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_funds');
    }
};