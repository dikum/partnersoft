<?php

namespace App\Http\Controllers\Email;

use App\Email;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Transformers\EmailTransformer;
use Illuminate\Http\Request;

class EmailController extends ApiBaseController
{


    public function __construct()
    {

        $this->middleware('auth:api');

        $this->middleware('transform.input:' . EmailTransformer::class)->only(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny');

        $emails = Email::all();

        return $this->showAll($emails);
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
        $this->authorize('view', $email);

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
    public function destroy(Email $email)
    {
        $this->authorize('delete', $email);

        $email->delete();
        return $this->showOne($email);

    }
}
