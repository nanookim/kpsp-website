<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kpsp_jawaban', function (Blueprint $table) {
            $table->string('jawaban', 10)->change(); // bisa "ya" atau "tidak"
        });
    }

    public function down(): void
    {
        Schema::table('kpsp_jawaban', function (Blueprint $table) {
            $table->integer('jawaban')->change(); // revert ke integer
        });
    }
};
