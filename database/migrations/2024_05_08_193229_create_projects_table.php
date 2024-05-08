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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('project_estimated_time');
            $table->date('project_start_date');
            $table->date('project_end_date');
            $table->decimal('project_investment', 12,2); // max = 999,999,999.99
            $table->int('project_total_worked_days');
            $table->boolean('project_state');
            $table->unsignedBigInteger('inversors_id');
            $table->decimal('inversors_investment_amount', 10, 2);
            $table->decimal('inversors_profit_perc', 5, 2); // max = 999.99
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
