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
        Schema::create('resume_certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('authority_id')->constrained('education_organizations');
            $table->foreignId('employer_sponsor_id')->constrained('employer_organizations')->nullable();
            $table->string('url');
            $table->string('license_number');
            $table->date('start_date');
            $table->boolean('is_current')->default(false);
            $table->date('expiration_date')->nullable();
            $table->boolean('is_expired')->default(false);
            $table->string('logo');

            // create a composite unique index on name and authority_id
            $table->unique(['name', 'authority_id']);
            // create a composite unique index on name and employer_sponsor_id
            $table->unique(['name', 'employer_sponsor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_certifications');
    }
};
