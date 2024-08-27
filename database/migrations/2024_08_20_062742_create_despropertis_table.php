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
        Schema::create('despropertis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_product')->unique();
            $table->string('jenisproperti');
            $table->string('lokasi');
            $table->string('fasilitas');
            $table->string('ltanah');
            $table->string('lbangunan');
            $table->string('jmlhruangan');
            $table->string('deskripsi');
            $table->date('dari_tgl')->nullable();
            $table->date('sampai_tgl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despropertis');
    }
};
