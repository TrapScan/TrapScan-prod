<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnonFlagToInspectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->boolean('anon')->default(false);

            $table->index('anon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropIndex('anon');
            $table->dropColumn('anon');
        });
    }
}
