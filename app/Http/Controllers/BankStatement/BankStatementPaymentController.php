<?php

namespace App\Http\Controllers\BankStatement;

use App\BankStatement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankStatementPaymentController extends Controller
{
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
