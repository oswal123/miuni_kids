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
        Schema::dropIfExists('ejercicios');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('numero1'); // Primer número de un dígito
            $table->tinyInteger('numero2'); // Segundo número de un dígito
            $table->tinyInteger('numero3'); // Tercer número de un dígito
            $table->tinyInteger('numero4'); // Cuarto número de un dígito
            $table->boolean('resuelto')->default(false); // Para saber si el ejercicio fue resuelto
            $table->timestamps();
        });
    }
};
