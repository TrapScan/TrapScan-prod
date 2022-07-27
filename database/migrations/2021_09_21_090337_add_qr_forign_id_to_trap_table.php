<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrForignIdToTrapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traps', function (Blueprint $table) {
            $table->foreign('qr_id')->references('qr_code')->on('qr');
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
            $table->dropForeign('qr_id');
        });
    }
}
