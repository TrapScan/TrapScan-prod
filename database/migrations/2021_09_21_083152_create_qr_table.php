<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr', function (Blueprint $table) {
            $table->id();
            $table->string('qr_code')->unique();
            $table->foreignId('trap_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('trap_id')->references('id')->on('traps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qr');
    }
}
