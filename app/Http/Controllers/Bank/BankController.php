<?php

namespace App\Http\Controllers\Bank;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();

        return response()->json(['data'=>$banks], 200);
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

        return response()->json(['data'=>$bank], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = Bank::findOrFail($id);

        return response()->json(['data'=>$bank], 200);
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
        $bank = Bank::findOrFail($id);

        if($request->has('bank'))
            $bank->bank = $request->bank;

        if($request->has('bank_code'))
            $bank->bank_code = $request->bank_code;        

        if(!$bank->isDirty())
        {
            return response()->json(['error' => 'No field has been updated', 'code' => 422], 422);
        }

        $bank->save();

        return response()->json(['data' => $bank], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return response()->json(['data' => $bank], 200);
    }
}
