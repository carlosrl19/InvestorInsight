<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('project_estimated_time');
            $table->date('project_start_date');
            $table->date('project_end_date');
            $table->decimal('project_investment', 12,2); // max = 999,999,999.99
            $table->integer('project_total_worked_days')->nullable();
            $table->boolean('project_status');
            $table->string('project_final_note')->nullable();
            $table->unsignedBigInteger('investor_id');
            $table->decimal('investor_investment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
