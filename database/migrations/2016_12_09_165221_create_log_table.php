<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diff_id')->unsigned()->index();
            $table->string('database')->index();
            $table->string('table')->index()->nullable();
            $table->string('column')->index()->nullable();
            $table->string('type')->index();
            $table->string('field')->index()->nullable();
            $table->text('message')->nullable();
            $table->boolean('result')->index();
            $table->timestamps();

            $table->foreign('diff_id')->references('id')->on('diffs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
