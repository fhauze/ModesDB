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
            $table->unsignedBigInteger('org_id')->nullable();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('jenis_usaha');
            $table->unsignedBigInteger('pekerja')->nullable();
            $table->unsignedBigInteger('vol_produksi')->nullable();
            $table->boolean('ekspor')->default(false);
            $table->string('tujuan_ekspor')->nullable();
            $table->integer('volume_ekspor')->nullable();
            $table->string('distribusi_ke')->nullable();
            $table->string('lokasi_usaha');
            $table->timestamps();

            $table->foreign('org_id')->references('id')->on('organization')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('orang')->onDelete('cascade');
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
