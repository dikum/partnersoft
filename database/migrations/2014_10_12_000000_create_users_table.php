<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('partner_id')->nullable();
            $table->string('title_id');
            $table->string('state_id');
            $table->string('currency_id');
            $table->string('status');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('email2')->nullable();
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('sex');
            $table->date('date_of_birth');
            $table->string('marital_status');
            $table->string('occupation');
            $table->string('donation_type');
            $table->float('donation_amount', 8,2);
            $table->string('birth_country'); //Country ID
            $table->string('residential_country'); //Country ID
            $table->text('residential_address');
            $table->text('postal_address');
            $table->string('preflang')->default(Partner::ENGLISH_PREFERRED_LANGUAGE);
            $table->string('password');
            $table->string('type');
            $table->string('branch');
            $table->string('registered_by')->nullable();
            $table->rememberToken();
            $table->string('verified')->default(User::UNVERIFIED_USER);
            $table->string('verification_token')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('title_id')->references('title_id')->on('titles');
            $table->foreign('currency_id')->references('currency_id')->on('currencies');
            $table->foreign('state_id')->references('state_id')->on('states');
            $table->foreign('birth_country')->references('country_id')->on('countries');
            $table->foreign('residential_country')->references('country_id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
