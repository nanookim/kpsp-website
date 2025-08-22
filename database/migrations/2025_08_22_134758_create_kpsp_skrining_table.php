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
        Schema::create('kpsp_skrining', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anak')->constrained('children')->onDelete('cascade');
            $table->foreignId('id_set_kpsp')->constrained('kpsp_set_pertanyaan');
            $table->date('tanggal_skrining');
            $table->integer('skor_mentah');
            $table->string('hasil_interpretasi', 50);
            $table->text('rekomendasi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpsp_skrining');
    }
};
