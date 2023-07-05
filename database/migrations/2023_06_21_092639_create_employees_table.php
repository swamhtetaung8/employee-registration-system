<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations for employees table
     *
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     *
     */

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id')->unique();
            $table->string('employee_code',50);
            $table->string('employee_name',50);
            $table->string('nrc_number',50);
            $table->string('password',255);
            $table->string('email_address',255)->unique();
            $table->integer('gender')->nullable();
            $table->date('date_of_birth');
            $table->integer('marital_status')->nullable();
            $table->longText('address')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
