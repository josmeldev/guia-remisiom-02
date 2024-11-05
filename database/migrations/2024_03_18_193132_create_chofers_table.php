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
        Schema::create('chofers', function (Blueprint $table) {
            $table->id();
            $table->string('dni',8)->unique();
            $table->string('nombre_apellidos',50);
            $table->string('telefono',11)->unique();
            $table->string('brevete',11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chofers');
    }
};
