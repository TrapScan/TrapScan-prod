<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nz_trap_id')->nullable();
            $table->foreignId('trap_line_id')->nullable();
            $table->string('qr_id')->nullable();
            $table->foreignId('project_id')->nullable();
            $table->foreignId('user_id')->nullable();

            $table->index('qr_id');
            $table->index('nz_trap_id');

            $table->foreign('trap_line_id')->references('id')->on('traps');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('traps');
    }
}
