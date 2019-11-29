<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_comments', function (Blueprint $table) {
            $table->uuid('comment_id')->primary();
            $table->string('partner_id');
            $table->string('user_id');
            $table->text('comment');
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
        Schema::dropIfExists('partner_comments');
    }
}
