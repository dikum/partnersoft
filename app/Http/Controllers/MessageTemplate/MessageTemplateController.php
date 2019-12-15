<?php

namespace App\Http\Controllers\MessageTemplate;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\MessageTemplate;
use App\Transformers\MessageTemplateTransformer;
use Illuminate\Http\Request;

class MessageTemplateController extends ApiBaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . MessageTemplateTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = MessageTemplate::all();

        return showAll($messages);
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
            'title' => 'required',
            'message' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $message = MessageTemplate::create($data);

        return $this->showOne($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MessageTemplate $message)
    {
        return $this->showOne($message);
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
    public function update(Request $request, MessageTemplate $message)
    {
        //$this->validate($request, $rules);

        if($request->has('title'))
            $message->title = $request->title;

        if($request->has('message'))
            $message->message = $request->message;


        if(!$message->isDirty())
        {
            return $this->errorResponse()->json('No field has been updated', 422);
        }

        $message->save();

        return $this->showOne($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageTemplate $message)
    {
        $message->delete();
        return $this->showOne($message);
    }
}
