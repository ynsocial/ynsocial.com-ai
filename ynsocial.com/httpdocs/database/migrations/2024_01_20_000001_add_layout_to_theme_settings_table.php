<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLayoutToThemeSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('theme_settings', 'layout')) {
                $table->string('layout')->default('default')->after('custom_js');
            }
        });
    }

    public function down()
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            if (Schema::hasColumn('theme_settings', 'layout')) {
                $table->dropColumn('layout');
            }
        });
    }
} 