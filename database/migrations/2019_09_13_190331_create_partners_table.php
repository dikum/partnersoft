<?php

use App\Partner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partner_id')->nullable();
            $table->integer('title_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('surname');
            $table->string('middle_name')->nullable();
            $table->string('first_name');
            $table->string('sex');
            $table->date('date_of_birth');
            $table->string('marital_status');
            $table->string('occupation');
            $table->text('note')->nullable();
            $table->string('donation_type');
            $table->float('donation_amount', 8,2);

            $table->integer('birth_country')->unsigned(); //Country ID
            $table->integer('residential_country')->unsigned(); //Country ID
            $table->string('email');
            $table->string('email2')->nullable();
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->text('residential_address');
            $table->text('postal_address');

            $table->string('preflang')->default(Partner::ENGLISH_PREFERRED_LANGUAGE);
            $table->string('status')->default(Partner::PENDING_STATUS);
            $table->string('password');
            $table->string('verified')->default(Partner::UNVERIFIED_PARTNER);
            $table->rememberToken();
            $table->string('verification_token')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('birth_country')->references('id')->on('countries');
            $table->foreign('residential_country')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
