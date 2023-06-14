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
        // create student table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId')->unique();
            $table->float('gpa');
            $table->string('university');
            $table->string('major');
            $table->date('dateEnrolled');
            $table->integer('credits');
            
            $table->foreign('userId')->references('id')->on('users');
        });

        // create company table
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId')->unique();
            $table->integer('numEmployees');
            $table->string('field');
            $table->integer('foundingYear');
            $table->string('description');
            $table->string('website');
            $table->string('address');
            
            $table->foreign('userId')->references('id')->on('users');
        });
        
        // create offer table
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('companyId')->unique();
            $table->string('field');
            $table->integer('salary');
            $table->date('dateFrom');
            $table->date('dateTo');
            $table->string('description');
            $table->string('requirements');
            
            $table->foreign('companyId')->references('id')->on('companies');
        });

        // create application table
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studentId')->unique();
            $table->unsignedBigInteger('offerId')->unique();
            $table->string('status');

            $table->foreign('studentId')->references('id')->on('students');
            $table->foreign('offerId')->references('id')->on('offers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop application table
        Schema::dropIfExists('applications');
        
        // drop offer table
        Schema::dropIfExists('offers');
        
        // drop company table
        Schema::dropIfExists('companies');
        
        // drop student table
        Schema::dropIfExists('students');

    }
};
