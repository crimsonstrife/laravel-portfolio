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
        Schema::create('resume_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained('education_organizations');
            $table->enum('degree', ['certificate', 'diploma', 'associate', 'bachelor', 'master', 'doctorate']);
            $table->string('major')->nullable();
            $table->string('minor')->nullable();
            $table->string('gpa')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->date('expected_date')->nullable();
            $table->date('graduation_date')->nullable();
            $table->boolean('is_graduated')->default(false);

            // create a composite unique index on institution_id and major
            $table->unique(['institution_id', 'major']);
            // create a composite unique index on institution_id and minor
            $table->unique(['institution_id', 'minor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_education');
    }
};
