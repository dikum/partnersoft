<?php

use App\Partner;
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
            $table->string('title_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('status');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('email2')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('occupation')->nullable();
            $table->string('donation_type')->nullable();
            $table->float('donation_amount', 8,2)->nullable();
            $table->string('birth_country')->nullable(); //Country ID
            $table->string('residential_country')->nullable(); //Country ID
            $table->text('residential_address')->nullable();
            $table->text('postal_address')->nullable();
            $table->string('preflang')->default(Partner::ENGLISH_PREFERRED_LANGUAGE)->nullable();
            
            $table->string('type');
            $table->string('branch');
            $table->string('photo');
            $table->string('registered_by')->nullable();
            $table->string('password');
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
