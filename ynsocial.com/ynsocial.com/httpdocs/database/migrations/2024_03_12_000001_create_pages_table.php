<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('sections')->nullable(); // Store page sections as JSON
            $table->json('meta')->nullable(); // Store meta information
            $table->boolean('active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create page sections table for reusable sections
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // hero, content, services, team, stats, etc.
            $table->json('content');
            $table->boolean('active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Create pivot table for pages and sections
        Schema::create('page_section_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->foreignId('page_section_id')->constrained()->onDelete('cascade');
            $table->json('content')->nullable(); // Override section content if needed
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_section_pivot');
        Schema::dropIfExists('page_sections');
        Schema::dropIfExists('pages');
    }
}; 