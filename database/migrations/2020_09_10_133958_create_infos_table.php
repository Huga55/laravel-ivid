<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->integer('tariff_id')->default(1);
            $table->integer('user_id');
            $table->integer('month')->default(1);
            $table->decimal('money', 11, 2)->default(0.00);
            $table->boolean('status')->default(false);
            $table->boolean('autopay')->default(false);
            $table->date('date_next_pay')->nullable()->default(null);
            $table->integer('price_next_pay')->default(0);
            $table->string('rebillID')->default("");
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
        Schema::dropIfExists('infos');
    }
}
