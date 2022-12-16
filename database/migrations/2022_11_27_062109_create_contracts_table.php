<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('contract_name')->nullable();
            $table->string('currency')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->double('wages')->nullable();
            $table->double('pph21')->nullable();
            $table->double('food')->nullable();
            $table->double('transport')->nullable();
            $table->boolean('active')->nullable();
            $table->integer('work_day')->nullable();
            $table->integer('bpjs_category_id')->unsigned();
            $table->foreign('bpjs_category_id')->references('id')->on('bpjs_datas')->onDelete('restrict');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contracts');
    }
}
