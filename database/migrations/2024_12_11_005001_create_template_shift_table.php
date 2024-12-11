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
        Schema::create('template_shift', function (Blueprint $table) {
            $table->id(); // Clave primaria
        $table->enum('tipodeturno', ['tienda', 'online']); // Tipo de turno (tienda o online)
        $table->date('date'); // Fecha del turno
        $table->time('hour'); // Hora del turno
        $table->integer('duration'); // Duración del turno
        $table->boolean('completed')->default(false); // Estado de si el turno fue realizado o no
        $table->foreignId('template_week_id')->constrained('template_week')->onDelete('cascade'); // Relación con template_week
        $table->timestamps(); // Tiempos de creación y actualización
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_shift');
    }
};
