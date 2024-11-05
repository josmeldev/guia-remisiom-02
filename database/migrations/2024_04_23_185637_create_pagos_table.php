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
        Schema::create('pagos', function (Blueprint $table) {
            
            $table->id(); 
            $table->decimal('Adelanto', 10, 2);
            $table->string('Metodo_Pago', 50)->nullable();
            $table->string('Tipo_Pago', 50)->nullable();
            $table->string('Nro_Operacion', 50)->nullable();
            $table->decimal('Monto', 10, 2)->nullable();
            $table->decimal('Precio_Unitario', 10, 2);
            $table->unsignedBigInteger('guia_id');
            $table->timestamps();
            $table->foreign('guia_id')->references('id')->on('guias')->onDelete('cascade');









        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
