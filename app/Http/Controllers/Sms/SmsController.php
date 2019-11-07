<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Sms;
use Illuminate\Http\Request;

class SmsController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms = SmsController::all();

        return $this->showAll($sms);
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
            'sender' => 'required',
            'recipient' => 'required',
            'message' => 'required',
            'status' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $sms = Sms::create($data);

        return $this->showOne($sms, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sms = Sms::findOrFail($id);

        return $this->showOne($sms);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
