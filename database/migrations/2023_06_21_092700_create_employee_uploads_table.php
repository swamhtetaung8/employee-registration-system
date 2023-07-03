<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeUploadsTable extends Migration
{
    /**
     * Run the migrations for employee_uploads table
     *
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     *
     */
    public function up()
    {
        Schema::create('employee_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->string('file_path',500);
            $table->integer('file_size');
            $table->string('file_extension',50);
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
        Schema::dropIfExists('employee_uploads');
    }
}
