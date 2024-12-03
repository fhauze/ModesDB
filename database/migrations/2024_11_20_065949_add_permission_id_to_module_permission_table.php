<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('module_permission', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('module_permission', function (Blueprint $table) {
            $table->dropColumn('permission_id');
        });
    }

};
