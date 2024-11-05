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
        Schema::create('agricultors', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',11)->unique();
            $table->string('razon_social',100);
            $table->string('direccion',100);
            $table->string('representante',50)->nullable();
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
