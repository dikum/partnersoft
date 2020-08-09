<?php

namespace App\Http\Controllers\Payment;

use App\BankStatement;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


//This class should be deleted, has no use for now.
class PaymentBankStatementController extends ApiBaseController
{

    public function __construct()
    {

        $this->middleware('auth:api');

       $this->middleware('transform.input:' . BankTransformer::class)->only(['store', 'update']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Payment $payment)
    {
        DB::enableQueryLog();

        return $this->showOne(BankStatement::find($payment->bank_statement_id));
        //dd(DB::getQueryLog());
    }

}
