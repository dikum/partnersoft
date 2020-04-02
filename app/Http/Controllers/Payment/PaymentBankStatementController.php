<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentBankStatementController extends ApiBaseController
{

    public function __construct()
    {
        parent::__construct();

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
        $payments = $payment->bank_statement;

        return $this->showOne($payments);
        //dd(DB::getQueryLog());
    }

}
