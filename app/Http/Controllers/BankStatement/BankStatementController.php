<?php

namespace App\Http\Controllers\BankStatement;

use App\BankStatement;
use App\Currency;
use App\Helpers\CurrencyHelper;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Transformers\BankStatementTransformer;
use App\User;
use Illuminate\Http\Request;

class BankStatementController extends ApiBaseController
{

    public function __construct()
    {

        $this->middleware('auth:api');

        //$this->middleware('transform.input:' . BankStatementTransformer::class)->only(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', BankStatement::class);

        $branch = auth()->user()->branch;
        $type = auth()->user()->type;

        if($type == User::ADMIN_USER || $branch == User::LAGOS_BRANCH)
            return $this->showAll(BankStatement::all());

        if($branch == User::SOUTH_AFRICA_BRANCH)
            return $this->showAll(BankStatement::where('currency_id', CurrencyHelper::get_currency_id_with_code('ZAR'))->get());

        if($branch == User::GHANA_BRANCH)
            return $this->showAll(BankStatement::where('currency_id', CurrencyHelper::get_currency_id_with_code('GHS'))->get());
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
            'payment_date' => 'required|date',
            'value_date' => 'required|date',
            'payment_channel' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required',
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
    public function show(BankStatement $bankstatement)
    {
        
        $this->authorize('view', $bankstatement);

        $branch = auth()->user()->branch;
        $type = auth()->user()->type;
        //dd($bank_statement);

        if($type == User::ADMIN_USER || $branch == User::LAGOS_BRANCH)
            return $this->showOne($bankstatement);

        if($branch == User::SOUTH_AFRICA_BRANCH && CurrencyHelper::get_currency_code($bank_statement->bank_statement_id) == 'ZAR')
            return $this->showOne($bankstatement);

        if($branch == User::GHANA_BRANCH && CurrencyHelper::get_currency_code($bank_statement->bank_statement_id) == 'GHS')
            return $this->showOne($bankstatement);

        return $this->errorResponse('Sorry, This action is not authorized', 403);

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
        //$this->authorize('update', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankStatement $bankstatement)
    {
        $this->authorize('delete', $bankstatement);
        $bank_statement->delete();
        return $this->showOne($bankstatement);
    }
}
