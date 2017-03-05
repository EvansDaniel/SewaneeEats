<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');

            // order id number in case it is a issue with the number
            $table->integer('order_id')->nullable()->unsigned();
            $table->string('subject');
            $table->string('body');

            // id of admin that is corresponding
            $table->string('admin_id')->nullable();

            // actions that have been taken
            // no response yet
            $table->boolean('not_viewed');
            // admin is handling the issue
            $table->boolean('is_corresponding');
            // admin has resolved the issue
            $table->boolean('is_resolved');

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
        Schema::dropIfExists('issues');
    }
}
