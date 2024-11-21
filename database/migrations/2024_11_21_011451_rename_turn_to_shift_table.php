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
                // Renombrar la tabla 'turn' a 'shift'

            Schema::rename('turns', 'shift');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Renombrar de nuevo 'shift' a 'turn' si se revierte la migración
        Schema::rename('shift', 'turns');
    }
};
