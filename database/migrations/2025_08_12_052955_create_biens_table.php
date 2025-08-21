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
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institucion_id')->nullable()->constrained('institucions')->onDelete('set null');
            $table->string('codigo_patrimonial', 50);
            $table->string('tipo_bien', 50)->nullable();
            $table->string('marca', 100);
            $table->string('modelo', 100)->nullable();
            $table->string('nro_serie', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('oficina_ubicacion', 100)->nullable();
            $table->string('estado', 50)->nullable();
            $table->date('fecha_adquisicion')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens');
    }
};
