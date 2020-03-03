<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendMoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->string('usd_amo')->nullable();
            $table->string('usd_charge')->nullable();
            $table->integer('to_currency')->nullable();
            $table->string('to_currency_amo')->nullable();
            $table->integer('from_currency')->nullable();
            $table->string('from_currency_amo')->nullable();
            $table->string('trx')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->integer('merchant_id')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('send_moneys');
    }
}
