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
        Schema::create('kpsp_pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_set_kpsp')->constrained('kpsp_set_pertanyaan')->onDelete('cascade');
            $table->text('teks_pertanyaan');
            $table->integer('nomor_urut');
            $table->string('domain_perkembangan', 50)->nullable();
            $table->string('url_ilustrasi', 255)->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpsp_pertanyaan');
    }
};
