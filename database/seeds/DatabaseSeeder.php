<?php

use App\Bank;
use App\BankStatement;
use App\Continent;
use App\Country;
use App\Currency;
use App\Email;
use App\LastPartnerNumber;
use App\MessageTemplate;
use App\Partner;
use App\PartnerComment;
use App\Payment;
use App\Sms;
use App\State;
use App\Title;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Bank::truncate();
        BankStatement::truncate();
        Continent::truncate();
        Country::truncate();
        Currency::truncate();
        Email::truncate();
        LastPartnerNumber::truncate();
        MessageTemplate::truncate();
        Partner::truncate();
        PartnerComment::truncate();
        Payment::truncate();
        Sms::truncate();
        State::truncate();
        Title::truncate();
        User::truncate();

        $bankQuantity = 2;
        $bankStatementQuantity = 100;
        $continentQuantity = 7;
        $countryQuantity = 50;
        $currencyQuantity = 6;
        $emailQuantity = 25;
        $lastPartnerNumberQuantity = 1;
        $messageTemplateQuantity = 1;
        $partnerComment = 200;
        $partnerQuantity = 50;
        $paymnentQuantity = 100;
        $smsQuantity = 25;
        $emailQuantity = 25;
        $stateQuantity = 36;
        $titleQuantity = 5;
        $userQuantity = 5;


        factory(Bank::class, $bankQuantity)->create();
        factory(Currency::class, $currencyQuantity)->create();
        factory(MessageTemplate::class, $messageTemplateQuantity)->create();
        factory(Title::class, $titleQuantity)->create();
        factory(Continent::class, $continentQuantity)->create();
       	factory(Country::class, $countryQuantity)->create();
       	factory(State::class, $stateQuantity)->create();
        factory(User::class, $userQuantity)->create();
        factory(LastPartnerNumber::class, $lastPartnerNumberQuantity);
        factory(Partner::class, $partnerQuantity,)->create();
        factory(BankStatement::class, $bankStatementQuantity)->create();
        factory(Email::class, $emailQuantity)->create();
        factory(PartnerComment::class, $partnerComment)->create();
        factory(Payment::class, $paymnentQuantity)->create();
        factory(Sms::class, $smsQuantity)->create();
    }
}
