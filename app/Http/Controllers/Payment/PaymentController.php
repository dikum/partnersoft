<?php

namespace App\Http\Controllers\Payment;

use App\BankStatement;
use App\Helpers\UserHelper;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Payment;
use App\Transformers\PaymentTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class PaymentController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('transform.input:' . PaymentTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Payment $payment)
    {
    
        $this->authorize('viewAny', Payment::class);

        $payments = Payment::with('bank_statement');
               
        foreach(request()->query as $query => $value){
            if($query == 'sort_by')
                $sort_by_attribute = PaymentTransformer::originalAttribute($value);
            else
                $attribute = PaymentTransformer::originalAttribute($query);

            if(isset($attribute, $value))
            {
                $payments->whereHas('bank_statement', function($query) use ($attribute, $value){
                    $query->where($attribute, 'LIKE',  "%$value%");
                });
            }
        }
        $payments = $payments
        ->orderBy($sort_by_attribute, 'desc')
        ->get();

        return $this->showAll($payments);
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

        if(isset($request->entered_by))
            $data['entered_by'] = UserHelper::get_users_name($request->entered_by);
        else
            $data['entered_by'] = Payment::PAYMENT_ENTERED_BY_SYSTEM;

        $payment = Payment::create($data);

        return $this->showOne($payment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);
        return $this->showOne($payment);
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
    public function update(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);

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
            return $this->errorResponse('No field has been updated', 422);
        }

        $payment->save();

        return $this->showOne($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);
        $payment->delete();
        return response()->json(['data' => $payment], 200);
    }
}
