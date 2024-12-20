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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->enum('tipodeturno', ['tienda', 'online']); // Tipo de turno (tienda o online)
            $table->date('date'); // Fecha del turno
            $table->time('hour'); // Hora del turno
            $table->integer('duration'); // Duración del turno
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Usuario puede ser null inicialmente
            $table->boolean('completed')->default(false); // Estado de si el turno fue realizado o no
            $table->foreignId('week_id')->constrained('weeks')->onDelete('cascade'); // Relación con la semana a la que pertenece el turno
            $table->timestamps(); // Tiempos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
