<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('request_type');
            $table->string('department_name');
            $table->string('doctor_id');
            $table->foreign('doctor_id')->references('doctor_id')->on('users');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('number_of_days');
            $table->string('leave_reason');
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
        Schema::dropIfExists('leave_managements');
    }
}
