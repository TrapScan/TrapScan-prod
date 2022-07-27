<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoordiantesAndNameToTrapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traps', function (Blueprint $table) {
            $table->point('coordinates');
            $table->string('name')->nullable()->default(null);

            $table->spatialIndex('coordinates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traps', function (Blueprint $table) {
            $table->dropSpatialIndex('coordinates');
            $table->dropColumn('coordinates');
            $table->dropColumn('name');
        });
    }
}
