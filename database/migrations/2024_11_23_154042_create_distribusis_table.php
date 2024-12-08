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
        Schema::create('distribusis', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi');
            $table->foreignId('kategory_id')->constrained('kategori');
            $table->foreignId('usaha_id')->constrained('usaha');
            $table->foreignId('jenis_id')->constrained('jenis');
            $table->string('jenis_distribusi')->nullable();
            $table->foreignId('negara_id')->constrained('negara')->nullable();
            $table->foreignId('provinsi_id')->constrained('provinsis')->nullable();
            $table->foreignId('kabkot_id')->constrained('kabupatens')->nullable();
            $table->integer('tahun');
            $table->decimal('volume', total:8,places:2 );
            $table->string('satuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusis');
    }
};
