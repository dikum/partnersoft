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
            $table->string('partner_id');
            $table->string('user_id')->nullable();
            $table->string('sender');
            $table->string('recipient');
            $table->text('message');
            $table->string('status')->default(Sms::MESSAGE_SENT);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('partner_id')->references('partner_uuid')->on('partners');
            $table->foreign('user_id')->references('user_id')->on('users');

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
