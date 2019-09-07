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
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->string('email')->unique();
            $table->string('password')->nullable(false);
            $table->string('username');
            $table->date('joining_date');
            $table->date('birthday');
            $table->string('nid_no')->nullable(false);
            $table->binary('nid_image');
            $table->string('gender',10)->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('country',50)->nullable(false);
            $table->string('city',50)->nullable(false);
            $table->string('state',50)->nullable(false);
            $table->string('postal_code',20)->nullable(false);
            $table->string('phone_number',20)->nullable(false);
            $table->binary('image');
            $table->string('department',20);
            $table->string('short_biography');
            $table->binary('status')->nullable(false);
            $table->string('doctor_id')->unique();
            $table->string('patient_id')->unique();
            $table->string('receptionist_id')->unique();
            $table->string('admin_id')->unique();
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
