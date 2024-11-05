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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger ('nro_factura')->unique();
            $table->string('razon_social')->nullable();
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('descripcion_producto')->nullable();
            $table->decimal('precio_unitario', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
