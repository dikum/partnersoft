<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\dd;

class PartnerPaymentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Partner $partner)
    {
        $payments = $partner->payments;
        $bank_statements = collect();
        foreach($payments as $payment)
        {
           $bank_statements =  $bank_statements->merge($payment->bank_statement);
        }
        return $this->showAll($payments);
    }
}
