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
        Schema::create('resume_employment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employer_id')->constrained('employer_organizations');
            $table->string('position');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->string('description');

            // create a composite unique index on employer_id and position and start_date
            $table->unique(['employer_id', 'position', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_employment');
    }
};
