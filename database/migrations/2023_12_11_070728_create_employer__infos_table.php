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
        Schema::create('employer__infos', function (Blueprint $table) {
            $table->id('emp_id');
            $table->foreignId('acce_id')
            ->constrained('employer__accs', 'acce_id')
            ->onDelete('cascade')  // ON DELETE CASCADE
            ->onUpdate('cascade'); // ON UPDATE CASCADE
            $table->string('Fname');
            $table->string('Lname');
            $table->string('Email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer__infos');
    }
};
