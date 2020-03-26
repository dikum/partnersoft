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
            $table->string('made_by');
            $table->string('bank_statement_id');
            $table->string('entered_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('made_by')->references('user_id')->on('users');
            $table->foreign('entered_by')->references('user_id')->on('users');
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
