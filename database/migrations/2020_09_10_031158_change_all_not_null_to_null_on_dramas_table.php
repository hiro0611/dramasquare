<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAllNotNullToNullOnDramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dramas', function (Blueprint $table) {
            $table->string('drama_title')->nullable()->change();
            $table->string('category_name')->nullable()->change();
            $table->string('drama_story')->nullable()->change();
            $table->string('drama_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dramas', function (Blueprint $table) {
            $table->string('drama_title')->nullable(false)->change();
            $table->string('category_name')->nullable(false)->change();
            $table->string('drama_story')->nullable(false)->change();
            $table->string('drama_image')->nullable(false)->change();
        });
    }
}
