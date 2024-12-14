<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    static $table = 'translations';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(static::$table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id');
            $table->text('language');
            $table->text('alias');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->text('featured_image')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('author_id');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_indexable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(static::$table);
    }
};
