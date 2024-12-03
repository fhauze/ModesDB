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
        Schema::create('usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreign('jenis_id')->references('id')->on('jenis');
            $table->text('alamat');
            $table->string('teknologi');
            $table->string('pekerja');
            $table->string('sertifikasi');
            $table->string('tahun_berdiri');
            $table->text('deskripsi');
            $table->string('social_media');
            $table->string('sosmed_accoutn');
            $table->string('website');
            $table->unsignedBigInteger('jenis_id');
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('provinsi_id');
            $table->unsignedBigInteger('kabkot_id');
            $table->unsignedBigInteger('person_id');

            $table->foreign('org_id')->references('id')->on('organization');
            $table->foreign('provinsi_id')->references('id')->on('provinsis');
            $table->foreign('kabkot_id')->references('id')->on('kabupatens');
            $table->foreign('person_id')->references('id')->on('person');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usahas');
    }
};
