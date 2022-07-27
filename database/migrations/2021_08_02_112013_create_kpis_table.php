<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->integer('total_inspections');
            $table->integer('total_catches');
            $table->integer('total_traps');
            $table->integer('total_projects');
            $table->integer('total_users');
            $table->float('average_catches_per_user');
            $table->float('average_inspections_per_user');
            $table->float('average_trap_per_project');
            $table->float('average_project_per_user');
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
        Schema::dropIfExists('kpis');
    }
}
