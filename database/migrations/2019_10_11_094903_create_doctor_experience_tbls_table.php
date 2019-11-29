<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorExperienceTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_experience_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedbigInteger('doctor_id');
            $table->foreign('doctor_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->string('institution');
            $table->string('position');
            $table->string('year_from');
            $table->string('year_to');
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
        Schema::dropIfExists('doctor_experience_tbls');
    }
}
