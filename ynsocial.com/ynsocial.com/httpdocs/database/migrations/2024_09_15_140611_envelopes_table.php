<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    static $table = 'envelopes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(static::$table, function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('email');
            $table->text('phone')->nullable();
            $table->text('subject')->nullable();
            $table->text('message')->nullable();
            $table->integer('unread')->default(1)->unsigned();
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
