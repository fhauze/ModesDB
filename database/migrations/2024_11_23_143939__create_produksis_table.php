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
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usaha_id')->nullable();
            $table->unsignedBigInteger('jenis_id')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->integer('tahun')->nullable();
            $table->unsignedBigInteger('pekerja')->nullable();
            $table->unsignedBigInteger('vol_produksi')->nullable();
            $table->string('bahan_baku')->default(false);
            $table->integer('persentase_bahan_lokal')->nullable();
            $table->integer('persentase_bahan_impor')->nullable();
            $table->timestamps();

            $table->foreign('org_id')->references('id')->on('organization')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksis');
    }
};
