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
        Schema::create('institucions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_modular', 20)->nullable();
            $table->string('nombre_ie', 150)->nullable();
            $table->string('nivel', 50)->nullable();
            $table->string('distrito', 100)->nullable();
            $table->string('provincia', 100)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->string('estado_institucion', 50)->nullable();
            $table->decimal('latitud', 18, 15)->nullable();
            $table->decimal('longitud', 18, 15)->nullable();
            $table->foreignId('director_id')->nullable()->constrained('directors')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institucions');
    }
};
