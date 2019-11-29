<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('payment_id')->primary();
            $table->string('partner_id');
            $table->string('bank_statement_id');
            $table->string('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('partner_id')->references('partner_uuid')->on('partners');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('bank_statement_id')->references('bank_statement_id')->on('bank_statements');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
