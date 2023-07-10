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
        Schema::create('offer_student', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->string('status');
            
            $table->unique(['offer_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_student');
    }
};
