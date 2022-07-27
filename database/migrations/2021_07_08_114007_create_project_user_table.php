<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('project_id');
            $table->boolean('coordinator')->default(false);
            $table->boolean('notify_catches')->default(true);
            $table->string('catch_filter', 500)->nullable()->default(null);
            $table->boolean('notify_inspections')->default(false);
            $table->boolean('notify_problems')->default(true);
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
        Schema::dropIfExists('project_user');
    }
}
