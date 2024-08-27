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
        Schema::create('desrents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_product')->unique();
            $table->string('jenismobil');
            $table->string('transmisi');
            $table->string('bahanbakar');
            $table->string('kapasitas');
            $table->string('deskripsi');
            $table->date('dari_tgl');
            $table->date('sampai_tgl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desrents');
    }
};
