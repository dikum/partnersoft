<?php

namespace App\Http\Controllers\Email;

use App\Email;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::all();

        return showAll($emails);
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
            'user_id' => 'required',
            'sender' => 'required',
            'recipient' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'status' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $email = Email::create($data);

        return $this->showOne($email, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return $this->showOne($email);
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
