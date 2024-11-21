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
       
        Schema::rename('task_turn', 'task_shift');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('task_shift', 'task_turn');
    }
};
