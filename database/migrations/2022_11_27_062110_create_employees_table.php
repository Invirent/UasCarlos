<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('identification_no')->nullable();
            $table->text('address')->nullable();
            $table->string('marriage_status')->nullable();
            $table->string('gender')->nullable();
            $table->integer('contract_id')->unsigned();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('restrict');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
