<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('patient_id');
            $table->foreign('patient_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->string('patient_name');
            $table->string('doctor_name');
            $table->string('department');
            $table->date('last_visit');
            $table->date('next_visit');
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
        Schema::dropIfExists('visit_histories');
    }
}
