<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_statements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('bank_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('partner_id')->nullable();
            $table->string('depositor');
            $table->text('description');
            $table->float('amount', 8,2);
            $table->dateTime('payment_date');
            $table->dateTime('value_date');
            $table->string('payment_channel');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_statements');
    }
}
