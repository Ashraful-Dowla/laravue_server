<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username');
            $table->date('joining_date');
            $table->date('birthday');
            $table->string('nid_no');
            $table->binary('nid_image');
            $table->string('gender',10);
            $table->string('address');
            $table->string('country',50);
            $table->string('city',50);
            $table->string('state',50);
            $table->string('postal_code',20);
            $table->string('phone_number',20);
            $table->binary('image')->nullable();
            $table->string('department',20)->nullable();
            $table->string('short_biography')->nullable();
            $table->binary('status');
            $table->string('doctor_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('receptionist_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('role',10);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
