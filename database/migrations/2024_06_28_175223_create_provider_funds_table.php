<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('provider_id');
            $table->dateTime('provider_change_date');
            $table->decimal('provider_old_funds',10,2);
            $table->decimal('provider_new_funds',10,2);
            $table->string('provider_new_funds_comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_funds');
    }
};
