<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 2048);
            $table->longText('description')->nullable();
            $table->date('date_execute');
            $table->boolean('is_finish')->default(false);
            $table->integer('user_id');
            $table->integer('executer_id');
            $table->integer('creater_id');
            $table->integer('task_list_id');
            $table->integer('claim_id')->nullable();
            $table->integer('city_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
