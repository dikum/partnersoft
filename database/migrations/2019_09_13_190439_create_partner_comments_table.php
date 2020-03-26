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
            $table->string('made_by');
            $table->string('to');
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('made_by')->references('user_id')->on('users');
            $table->foreign('to')->references('user_id')->on('users');
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
