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
            $table->string('project_code');
            $table->string('project_estimated_time');
            $table->date('project_start_date');
            $table->date('project_end_date');
            $table->decimal('project_investment', 12,2); // max = 999,999,999.99

            // Investors
            $table->decimal('investor_investment', 12,2); // max = 999,999,999.99 
            $table->integer('investor_profit_perc');
            $table->unsignedBigInteger('investor_id');

            // Commission agent
            $table->decimal('commissioner_commission', 12,2); // max = 999,999,999.99 
            $table->integer('commissioner_profit_perc');
            $table->unsignedBigInteger('commissioner_id');

            $table->boolean('project_status');
            $table->integer('project_total_worked_days')->nullable();
            $table->string('project_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
