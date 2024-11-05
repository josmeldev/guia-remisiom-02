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
        Schema::create('cargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chofer_id')->constrained('chofers')->onDelete('cascade'); // Llave foránea al conductor
            $table->string('total_carga_bruta');
            $table->string('total_material_extrano');
            $table->string('tara');
            $table->string('nro_ticket');
            $table->integer('km_origen');
            $table->integer('km_de_destino');
            $table->date('fecha_carga');
            $table->date('fecha_de_descarga');
            $table->unsignedBigInteger('RUC_Agricultor');
            $table->unsignedBigInteger('campo_id');
            $table->foreign('RUC_Agricultor')->references('id')->on('agricultors')->onDelete('cascade');
            $table->foreign('campo_id')->references('id')->on('campos')->onDelete('cascade');
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas');
    }
};
