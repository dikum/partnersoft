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
            $table->uuid('bank_statement_id')->primary();
            $table->string('transaction_id');
            $table->string('bank_id');
            $table->string('currency_id');
            $table->string('partner_id')->nullable();
            $table->string('depositor');
            $table->text('description');
            $table->float('amount', 8,2);
            $table->dateTime('payment_date');
            $table->dateTime('value_date');
            $table->string('payment_channel');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bank_id')->references('bank_id')->on('banks');
            $table->foreign('currency_id')->references('currency_id')->on('currencies');
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
