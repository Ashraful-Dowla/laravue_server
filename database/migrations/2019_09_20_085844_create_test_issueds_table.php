<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestIssuedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_issueds', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('bill_id')->references('id')->on('bill_issueds');
            $table->string('test_name');
            $table->string('price');
            $table->string('patient_id')->references('id')->on('users');
            $table->string('doctor_id')->references('id')->on('users');
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
        Schema::dropIfExists('test_issueds');
    }
}
