<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_code');
            $table->string('transfer_bank');
            $table->unsignedInteger('investor_id');
            $table->decimal('transfer_amount', 10,2);
            $table->string('transfer_img');
            $table->string('transfer_comment');
            $table->dateTime('transfer_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
