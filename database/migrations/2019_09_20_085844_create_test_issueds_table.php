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

            $table->unsignedbigInteger('bill_id');
            $table->foreign('bill_id')
                  ->references('id')->on('bill_issueds')
                  ->onDelete('cascade');

            $table->string('test_name');
            $table->string('price');
            $table->unsignedbigInteger('patient_id');
            $table->foreign('patient_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedbigInteger('doctor_id');
            $table->foreign('doctor_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedbigInteger('created_by');
            $table->foreign('created_by')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->unsignedbigInteger('updated_by');
            $table->foreign('updated_by')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('test_issueds');
    }
}
