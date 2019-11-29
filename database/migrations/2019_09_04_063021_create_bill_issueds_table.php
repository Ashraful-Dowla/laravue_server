<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillIssuedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_issueds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id');
            $table->unsignedbigInteger('patient_id');
            $table->foreign('patient_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->string('amount');
            $table->string('discount');
            $table->string('amount_after_discount');
            $table->string('due');
            $table->date('issued_date');
            $table->string('status');
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
        Schema::dropIfExists('bill_issueds');
    }
}
