<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_recharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->references('id')->on('users');
            $table->string('recharge_amount');
            $table->string('total_amount');
            $table->timestamps();
            $table->string('created_by')->references('id')->on('users');
            $table->string('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_recharges');
    }
}
