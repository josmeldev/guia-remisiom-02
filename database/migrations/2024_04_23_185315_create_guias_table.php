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
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision');
            $table->string('nro_ticket')->nullable()->unique();
            $table->date('fecha_partida');
            $table->string('punto_partida', 100);
            $table->string('punto_llegada', 100);
            $table->string('producto');
            $table->string('estado', 50)->default('Pendiente');
            $table->unsignedBigInteger('nro_factura')->nullable();
            $table->unsignedBigInteger('agricultor_id');
            $table->unsignedBigInteger('transportista_id');
            $table->unsignedBigInteger('carga_id');
            $table->timestamps();



            $table->foreign('agricultor_id')->references('id')->on('agricultors')->onDelete('cascade');
            $table->foreign('transportista_id')->references('id')->on('transportistas')->onDelete('cascade');
            $table->foreign('carga_id')->references('id')->on('cargas')->onDelete('cascade');
            $table->foreign('nro_factura')->references('nro_factura')->on('facturas')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guias');
    }
};
