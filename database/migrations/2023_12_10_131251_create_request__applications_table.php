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
        Schema::create('request__applications', function (Blueprint $table) {
            $table->id('rapp_id');
            $table->foreignId('app_id')
            ->constrained('applicant_infos', 'app_id')
            ->onDelete('cascade')  // ON DELETE CASCADE
            ->onUpdate('cascade'); // ON UPDATE CASCADE
            $table->foreignId('job_id')
            ->constrained('jobs', 'job_id')
            ->onDelete('cascade')  // ON DELETE CASCADE
            ->onUpdate('cascade'); // ON UPDATE CASCADE
            $table->string('Document');
            $table->enum('status', ['processing', 'approve', 'reject'])->default('processing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request__applications');
    }
};
