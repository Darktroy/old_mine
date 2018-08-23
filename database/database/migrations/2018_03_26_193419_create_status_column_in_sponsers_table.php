<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusColumnInSponsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsers', function (Blueprint $table) {
            $table->integer('status')->after('active')->default(0); //if 1 then list sponsers in country veiw
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
