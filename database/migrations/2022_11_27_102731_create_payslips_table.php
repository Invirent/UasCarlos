<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('restrict');
            $table->integer('contract_id')->unsigned();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('restrict');
            $table->string('currency')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('deduction')->nullable();
            $table->double('bonus')->nullable();
            $table->double('payslip_amount')->nullable();
            $table->integer('bank_account_id')->unsigned();
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('restrict');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payslips');
    }
}
