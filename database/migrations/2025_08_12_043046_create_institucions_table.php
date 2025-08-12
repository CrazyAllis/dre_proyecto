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
            $table->string('codigo_modular', 20);
            $table->string('nombre_ie', 150);
            $table->string('nivel', 50);
            $table->string('distrito', 100);
            $table->string('provincia', 100);
            $table->string('direccion', 150);
            $table->string('estado_institucion', 50);
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
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
