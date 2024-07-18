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
        Schema::create('promissory_note_commissioners', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('commissioner_id');
            $table->decimal('promissoryNoteCommissioner_amount', 10,2);
            $table->date('promissoryNoteCommissioner_emission_date');
            $table->date('promissoryNoteCommissioner_final_date');
            $table->string('promissoryNoteCommissioner_code');
            $table->boolean('promissoryNoteCommissioner_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promissory_note_commissioners');
    }
};
