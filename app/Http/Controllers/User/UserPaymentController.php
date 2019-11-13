<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserPaymentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $payments = $user->payments;

        $bankstatemnts = collect();

        foreach($payments as $payment)
        {
            $bankstatemnts = $bankstatemnts->merge($payment->bank_statement);
        }

        return $this->showAll($payments);
    }
}
