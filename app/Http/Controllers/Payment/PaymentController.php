<?php

namespace App\Http\Controllers\Payment;

use App\BankStatement;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PaymentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data'=>Payment::all()], 200);
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
            'partner_id' => 'required',
            'bankstatement_id' => 'required',
            'entered_by' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $payment = Payment::create($data);

        return response()->json(['data'=>$payment], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return response()->json(['data'=>$payment], 200);
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
        $payment = Payment::findOrFail($id);

        $rules = [

            'partner_id' => 'in:' . Partner::all(),
            'bankstatement_id' => 'in:' . BankStatement::all(),
            'entered_by' => 'in:' . User::all() . ',' . Payment::PAYMENT_ENTERED_BY_SYSTEM,
        ];

        if($request->has('partner_id'))
            $payment->partner_id = $request->partner_id;

        if($request->has('bankstatement_id'))
            $payment->bankstatement_id = $request->bankstatement_id;

        if($request->has('entered_by'))
            $payment->entered_by = $request->entered_by;

       
        if(!$payment->isDirty())
        {
            return response()->json(['error' => 'No field has been updated', 'code' => 422], 422);
        }

        $payment->save();

        return response()->json(['data' => $payment], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json(['data' => $payment], 200);
    }
}
