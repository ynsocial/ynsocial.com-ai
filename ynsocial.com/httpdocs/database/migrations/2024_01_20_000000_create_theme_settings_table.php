<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->json('colors')->nullable();
            $table->json('typography')->nullable();
            $table->json('header')->nullable();
            $table->json('footer')->nullable();
            $table->json('portfolio')->nullable();
            $table->json('blog')->nullable();
            $table->json('homepage')->nullable();
            $table->json('social_media')->nullable();
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            $table->string('layout')->default('default');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('theme_settings');
    }
} 