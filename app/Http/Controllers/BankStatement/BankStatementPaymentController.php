<?php

namespace App\Http\Controllers\BankStatement;

use App\BankStatement;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankStatementPaymentController extends ApiBaseController
{

    public function __construct()
    {

        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankStatement $bank)
    {
        $payment = $bank->payment;
        dd($payment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankStatement  $bankStatement
     * @return \Illuminate\Http\Response
     */
    public function show(BankStatement $bankStatement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankStatement  $bankStatement
     * @return \Illuminate\Http\Response
     */
    public function edit(BankStatement $bankStatement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankStatement  $bankStatement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankStatement $bankStatement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankStatement  $bankStatement
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankStatement $bankStatement)
    {
        //
    }
}
