<?php

use App\Email;
use App\Partner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->uuid('email_id')->primary();
            $table->string('to')->nullable();
            $table->string('sent_by')->nullable();
            $table->string('sender');
            $table->string('recipient');
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default(Email::MESSAGE_SENT);
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
        Schema::dropIfExists('emails');
    }
}
