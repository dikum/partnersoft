<?php

use App\Sms;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->uuid('sms_id')->primary();
            $table->string('to')->nullable();
            $table->string('sent_by')->nullable();
            $table->string('sender');
            $table->string('recipient');
            $table->text('message');
            $table->string('status')->default(Sms::MESSAGE_SENT);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('to')->references('user_id')->on('users');
            $table->foreign('sent_by')->references('user_id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
}
