<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportOverviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_overviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('patient_id');
            $table->foreign('patient_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->string('patient_name');
            $table->unsignedbigInteger('doctor_id');
            $table->foreign('doctor_id')
                              ->references('id')->on('users')
                              ->onDelete('cascade');
            $table->string('doctor_name');
            $table->string('department');
            $table->string('issued_date');
            $table->longText('report')->nullable();
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
        Schema::dropIfExists('report_overviews');
    }
}
