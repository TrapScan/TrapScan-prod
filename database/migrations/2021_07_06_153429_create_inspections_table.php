<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('trap_id');
            $table->foreignId('recorded_by');
            $table->integer('strikes');
            $table->string('species_caught');
            $table->string('status');
            $table->boolean('rebaited');
            $table->string('bait_type');
            $table->string('trap_condition');
            $table->string('notes');
            $table->string('words');

            $table->foreign('trap_id')->references('id')->on('traps');
            $table->foreign('recorded_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspections');
    }
}
