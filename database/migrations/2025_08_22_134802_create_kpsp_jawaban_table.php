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
        Schema::create('kpsp_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_skrining')->constrained('kpsp_skrining')->onDelete('cascade');
            $table->foreignId('id_pertanyaan')->constrained('kpsp_pertanyaan');
            $table->boolean('jawaban'); // true/false
            $table->timestamps();

            $table->unique(['id_skrining', 'id_pertanyaan']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpsp_jawaban');
    }
};
