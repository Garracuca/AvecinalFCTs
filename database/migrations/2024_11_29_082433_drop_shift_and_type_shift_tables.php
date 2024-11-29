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
        //
    
        Schema::dropIfExists('task_shift'); // Elimina la tabla pivote task_shift
        Schema::dropIfExists('shift');     // Elimina la tabla shift
        Schema::dropIfExists('type_shift');
    
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::create('type_shift', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('shift', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_shift_id')->constrained('type_shift')->cascadeOnDelete();
            $table->date('date');
            $table->time('hour');
            $table->integer('duration');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('completed')->default(false);
            $table->foreignId('week_id')->constrained('weeks')->cascadeOnDelete();
            $table->timestamps();
        });

          // Recrea la tabla task_shift
          Schema::create('task_shift', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade'); // Relación con tasks
            $table->foreignId('shift_id')->constrained('shift')->onDelete('cascade'); // Relación con shift
            $table->timestamps();
        });
    }
};
