<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
*User
*/
Route::resource('users', 'User\UserController', ['except' => ['edit', 'create']]);
Route::resource('users.payments', 'User\UserPaymentController', ['only' => ['index']]);

/**
*BankStatement
*/
Route::resource('bankstatements', 'BankStatement\BankStatementController', ['except' => ['edit', 'update', 'create']]);

/**
*Email
*/
Route::resource('emails', 'Email\EmailController', ['except' => ['create', 'edit', 'update']]);

/**
*MessageTemplate
*/
Route::resource('messagetemplates', 'MessageTemplate\MessageTemplateController');

/**
*Partner
*/
Route::resource('partners', 'Partner\PartnerController', ['except' => ['create', 'edit']]);
Route::resource('partners.messages', 'Partner\PartnerMessageController', ['only' => ['index']]);
Route::resource('partners.comments', 'Partner\PartnerCommentController', ['only' => ['index']]);
Route::resource('partners.payments', 'Partner\PartnerPaymentController', ['only' => ['index']]);

/**
*PartnerComment
*/
Route::resource('partnercomments', 'PartnerComment\PartnerCommentController', ['except' => ['edit', 'create']]);

/**
*PartnerMessage
*/
Route::resource('partnermessages', 'PartnerMessage\PartnerMessageController', ['only' => ['index', 'show', 'store']]);

/**
*BankStatement
*/
Route::resource('bankstatements', 'BankStatement\BankStatementController', ['except' => ['edit', 'create']]);
Route::resource('bankstatements.payment', 'BankStatement\BankStatementPaymentController', ['only' => ['index']]);

/**
*Sms
*/
Route::resource('sms', 'Sms\SmsController', ['except' => ['create', 'update', 'edit']]);

/**
*Title
*/
Route::resource('titles', 'Title\TitleController', ['except' => ['edit', 'create']]);

/**
*Bank
*/
Route::resource('banks', 'Bank\BankController', ['except' => ['edit', 'create']]);

/**
*Currency
*/
Route::resource('currencies', 'Currency\CurrencyController', ['except' => ['edit', 'create']]);

/**
*Payment
*/
Route::resource('payments', 'Payment\PaymentController', ['except' => ['edit', 'create']]);
Route::resource('payments.bankstatements', 'Payment\PaymentBankStatementController', ['only' => ['index']]);

/**
*Continent
*/
Route::resource('continents', 'Continent\ContinentController', ['only' => ['show', 'index', 'destroy']]);

/**
*Countries
*/
Route::resource('countries', 'Country\CountryController', ['only' => ['show', 'index']]);

/**
*State
*/
Route::resource('states', 'State\StateController', ['only' => ['show', 'index']]);
