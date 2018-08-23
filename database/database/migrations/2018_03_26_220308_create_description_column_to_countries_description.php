<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptionColumnToCountriesDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries_details', function (Blueprint $table) {
            $table->text('description')->after('flag'); //if 1 then list sponsers in country veiw
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries_details', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
