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
        Schema::create('desvnps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_product')->unique();
            $table->string('kategori');
            $table->string('Size');
            $table->string('bahan');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desvnps');
    }
};
