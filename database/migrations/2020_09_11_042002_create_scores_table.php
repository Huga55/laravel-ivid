<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->date("date");
            $table->time("time");
            $table->integer("price");
            $table->boolean("status")->nullable()->default(null);
            $table->string("transaction_id");
            $table->boolean("up")->nullable()->default(null);
            $table->boolean("down")->nullable()->default(null);
            $table->string('token');
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
        Schema::dropIfExists('scores');
    }
}
