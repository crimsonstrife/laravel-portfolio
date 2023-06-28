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
        Schema::create('employer_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('logo');
            $table->string('url');
            $table->timestamps();
            $table->enum('type', ['company', 'nonprofit', 'government', 'education', 'other'])->default('company');

            // create a composite unique index on name and location
            $table->unique(['name', 'location']);
            // create a composite unique index on logo and url
            $table->unique(['logo', 'url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_organizations');
    }
};
