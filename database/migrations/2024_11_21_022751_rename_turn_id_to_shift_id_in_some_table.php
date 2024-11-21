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
        Schema::table('some', function (Blueprint $table) {
            //
            $table->renameColumn('turn_id', 'shift_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('some', function (Blueprint $table) {
            //
            $table->renameColumn('shift_id', 'turn_id');
        });
    }
};
