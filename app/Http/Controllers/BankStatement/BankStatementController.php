<?php

namespace App\Http\Controllers\BankStatement;

use App\BankStatement;
use App\Currency;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankStatementController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_statements = BankStatement::all();
        return $this->showAll($bank_statements);
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
        $rules = [
            'transaction_id' => 'required',
            'bank_id' => 'required',
            'currency_id' => 'required',
            'partner_id' => 'nullable',
            'description' => 'nullable',
            'amount' => 'required',
            'payment_date' => 'required',
            'value_date' => 'required',
            'payment_channel' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $bank_statement = BankStatement::create($data);

        return $this->showOne($bank_statement, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BankStatement $bank_statement)
    {
        return $this->showOne($bank_statement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankStatement $bank_statement)
    {
        $bank_statement = BankStatement::findOrFail($id);
        $bank_statement->delete();
        return $this->showOne($bank_statement);
    }
}
