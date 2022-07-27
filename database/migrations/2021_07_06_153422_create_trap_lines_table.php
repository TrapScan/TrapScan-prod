<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrapLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trap_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable();
            $table->string('name');
            $table->string('sponsored_by')->nullable();

            $table->foreign('project_id')->references('id')->on('projects');

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
        Schema::dropIfExists('trap_lines');
    }
}
