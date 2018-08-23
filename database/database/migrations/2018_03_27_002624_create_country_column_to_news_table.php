<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryColumnToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->integer('country_id')->after('user_id')->default(null);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->integer('country_id')->after('user_id')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('country_id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('country_id');
        });
    }
}
