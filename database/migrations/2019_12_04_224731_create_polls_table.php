<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->string('slug');
            $table->string('ip');
            $table->string('agent');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('poll_id');
            $table->foreign('poll_id')
                ->references('id')
                ->on('polls')
                ->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')
                ->references('id')
                ->on('options')
                ->onDelete('cascade');
            $table->string('ip');
            $table->string('agent');
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->unsignedBigInteger('poll_id');
            $table->foreign('poll_id')
                ->references('id')
                ->on('polls')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('poll_id');
            $table->text('content');
            $table->string('email');
            $table->string('ip');
            $table->string('agent');
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
        Schema::dropIfExists('Responses');
        Schema::dropIfExists('options');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('polls');
    }
}
