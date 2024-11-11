<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agricultors', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',11)->unique()->nullable();
            $table->string('razon_social',100);
            $table->string('direccion',100);
            $table->string('representante',50)->nullable();
            $table->string('dni',8)->unique()->nullable();
            $table->string('numero_cuenta',20)->unique()->nullable();
            $table->string('banco',50)->nullable();
            $table->string('cci',20)->nullable();
            $table->string('correo_electronico',50)->nullable();
            $table->string('telefono',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agricultors');
    }
};
