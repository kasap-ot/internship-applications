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
        Schema::table('offer_student', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
                ->onDelete('cascade');
        });
        Schema::table('offer_student', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
        Schema::table('certifications', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->foreignId('student_id')->constrained();
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->foreignId('student_id')->constrained();
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->foreignId('company_id')->constrained();
        });
        Schema::table('offer_student', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->foreignId('student_id')->constrained();
        });
        Schema::table('offer_student', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->foreignId('offer_id')->constrained();
        });
    }
};
