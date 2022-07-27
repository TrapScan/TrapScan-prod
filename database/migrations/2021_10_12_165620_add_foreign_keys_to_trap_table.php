<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTrapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traps', function (Blueprint $table) {
            $table->dropForeign(['trap_line_id']);

            $table->foreign('trap_line_id')->references('id')->on('trap_lines');
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
            $table->dropForeign(['trap_line_id']);
        });
    }
}
