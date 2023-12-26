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
        Schema::create('applicant_infos', function (Blueprint $table) {
            $table->id('app_id');
            $table->foreignId('acc_id')->constrained('applicant__accs', 'acc_id'); // Specify the correct foreign key column
            $table->string('Fname');
            $table->string('Lname');
            $table->integer('Age');
            $table->string('Gender');
            $table->string('Email');
            $table->string('Address');
            $table->string('Birth_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_infos');
    }
};
