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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('source_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('banner')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->date('published_at')->nullable();
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->foreignId('employer_id')->constrained('employer_organizations')->nullable();
            $table->foreignId('institution_id')->constrained('education_organizations')->nullable();
            $table->foreignId('client_id')->constrained('project_clients')->nullable();
            $table->foreignId('type_id')->constrained('project_types');
            $table->boolean('has_demo')->default(false);
            $table->boolean('has_source')->default(false);
            $table->boolean('has_banner')->default(false);
            $table->boolean('has_thumbnail')->default(false);
            $table->boolean('has_employer')->default(false);
            $table->boolean('has_institution')->default(false);
            $table->boolean('has_client')->default(false);
            $table->boolean('has_images')->default(false);
            $table->enum('status', ['planned', 'in_progress', 'completed', 'incomplete', 'canceled'])->default('planned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
