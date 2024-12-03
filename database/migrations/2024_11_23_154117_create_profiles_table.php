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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->references('id')->on('person');
            $table->unsignedBigInteger('usaha_id')->nullable();
            $table->string('sertifikasi')->nullable();
            $table->string('fbid')->nullable();
            $table->string('igid')->nullable();
            $table->boolean('iscomplete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
