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
            $table->foreignId('category_id')->constrained('kategori');
            $table->foreignId('usaha_id')->constrained('usaha');
            $table->string('jenis_distribusi');
            $table->foreignId('kabkot_id')->constrained('kabupatens');
            $table->foreignId('negara_id')->constrained('negara');
            $table->decimal('volume', total:8,places:2 );
            $table->string('satuan');
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
