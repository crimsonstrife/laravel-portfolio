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
        Schema::create('certs_have_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cert_id')->constrained('resume_certifications');
            $table->foreignId('skill_id')->constrained('resume_skills');
            // create a composite unique index on cert_id and skill_id
            $table->unique(['cert_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certs_have_skills');
    }
};
