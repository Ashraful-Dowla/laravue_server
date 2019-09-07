<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefillAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refill_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('users');
            $table->string('amount');
            $table->date('date');
            $table->string('receipt_no');
            $table->timestamps();
            $table->timestamp('created_by')->nullable();
            $table->timestamp('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refill_accounts');
    }
}
