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
            $table->date('project_start_date');
            $table->date('project_end_date');
            $table->integer('project_work_days');
            $table->decimal('project_investment', 12,2); // max = 999,999,999.99
            $table->boolean('project_status');
            $table->string('project_comment');
            $table->string('project_close_comment')->nullable();
            $table->string('project_proof_transfer_img')->nullable();
            $table->decimal('investor_balance_history', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
