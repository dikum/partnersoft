<?php

namespace App\Http\Controllers\Currency;

use App\Currency;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Transformers\CurrencyTransformer;
use Illuminate\Http\Request;

class CurrencyController extends ApiBaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:api');

        $this->middleware('transform.input:' . CurrencyTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny');

        $currencies = Currency::all();

        return $this->showAll($currencies);
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
        $this->authorize('create');

        $rules = [
            'currency' => 'required',
            'currency_code' => 'required',
            'minimum_amount' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $currency = Currency::create($data);

        return response()->json(['data'=>$currency], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        $this->authorize('view', $currency);

        return $this->showOne($currency);
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

        $currency = Currency::findOrFail($id);

        $this->authorize('update', $currency);

        if($request->has('currency'))
            $currency->currency = $request->currency;

        if($request->has('currency_code'))
            $currency->currency_code = $request->currency_code;

        if($request->has('minimum_amount'))
            $currency->minimum_amount = $request->minimum_amount;

        if(!$currency->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        $currency->save();

        return $this->showOne($currency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $this->authorize('delete', $currency);

        $currency->delete();
        return $this->showOne($currency);
    }
}
