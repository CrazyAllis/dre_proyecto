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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institucion_id')->nullable()->constrained('institucions')->onDelete('set null');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedors')->onDelete('set null');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->decimal('velocidad_subida', 6, 2)->nullable();
            $table->decimal('velocidad_bajada', 6, 2)->nullable();
            $table->string('entidad_paga', 50)->nullable();
            $table->decimal('costo_mensual', 10, 2)->nullable();
            $table->string('estado_contrato', 50)->nullable();
            $table->text('observaciones')->nullable();
            $table->string('documento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
