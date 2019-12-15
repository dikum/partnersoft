<?php

namespace App\Http\Controllers\Bank;

use App\Bank;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Transformers\BankTransformer;
use Illuminate\Http\Request;

class BankController extends ApiBaseController
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
    public function index()
    {
        $banks = Bank::all();

        return $this->showAll($banks);
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
            'bank' => 'required',
            'bank_code' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $bank = Bank::create($data);

        return $this->showOne($bank, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return $this->showOne($bank);
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
    public function update(Request $request, Bank $bank)
    {
        if($request->has('bank'))
            $bank->bank = $request->bank;

        if($request->has('bank_code'))
            $bank->bank_code = $request->bank_code;        

        if(!$bank->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        $bank->save();

        return $this->showOne($bank);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        return $this->showOne($bank);
    }
}
