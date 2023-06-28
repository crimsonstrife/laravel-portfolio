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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('slug', 20)->unique();
            //WYSIWYG Content
            $table->mediumText('content');
            $table->string('image_path', 255)->nullable();
            $table->string('image_alt', 50)->nullable();
            $table->string('image_caption', 50)->nullable();
            $table->string('image_credit', 50)->nullable();
            $table->string('image_credit_link', 255)->nullable();
            //SEO
            $table->string('meta_title', 50)->nullable();
            $table->string('meta_description', 50)->nullable();
            $table->string('meta_keywords', 150)->nullable();
            //Social
            $table->string('social_title', 50)->nullable();
            $table->string('social_description', 50)->nullable();
            $table->string('social_image_path', 255)->nullable();
            //Status
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            //Timestamps
            $table->timestamp('published_at')->nullable();
            $table->timestamp('featured_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            //Relationships
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('blog_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
