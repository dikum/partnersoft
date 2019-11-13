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
            $table->increments('id');
            $table->integer('partner_id')->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('sender');
            $table->string('recipient');
            $table->text('message');
            $table->string('status')->default(Sms::MESSAGE_SENT);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('partner_id')->references('id')->on('partners');
            $table->foreign('user_id')->references('id')->on('users');

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
