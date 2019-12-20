<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->string('method');
            $table->string('url');
            $table->string('referer');
            $table->string('agent');
            $table->string('type'); // mobile, tablet, bot etc.
            $table->integer('is_bot'); // desktop, mobile, tablet, bot etc.
            $table->string('os');
            $table->string('browser');
            $table->string('country');
            $table->string('country_code');
            $table->string('city');
            $table->string('lat');
            $table->string('long');
            $table->string('language');
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
        Schema::dropIfExists('visitors');
    }
}
