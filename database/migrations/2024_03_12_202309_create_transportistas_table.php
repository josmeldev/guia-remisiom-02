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
        Schema::create('transportistas', function (Blueprint $table) {
            $table->id();
            $table->string('unidad_tecnica',10)->nullable();
            $table->string('campo',50)->nullable();
            $table->string('RUC',11)->unique();
            $table->string('razon_social',100);
            $table->string('direccion',100)->nullable();
            $table->string('zona',50)->nullable();
            $table->string('correo_electronico',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportistas');
    }
};
