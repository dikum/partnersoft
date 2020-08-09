<?php

namespace App\Http\Controllers\MessageTemplate;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\MessageTemplate;
use App\Transformers\MessageTemplateTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageTemplateController extends ApiBaseController
{

    public function __construct()
    {

        $this->middleware('auth:api');

        $this->middleware('transform.input:' . MessageTemplateTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', MessageTemplate::class);

        $messages = MessageTemplate::all();

        return $this->showAll($messages);
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
        $this->authorize('create', MessageTemplate::class);

        $validate = $request->validate([
            'title' => 'required|string|unique:message_templates',
            'message' => 'required|string'
        ]);

        //$this->validate($request, $rules);

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
    public function show(MessageTemplate $messagetemplate)
    {
        $this->authorize('view', $messagetemplate);

        return $this->showOne($messagetemplate);
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
    public function update(Request $request, MessageTemplate $messagetemplate)
    {
        $this->authorize('update', $messagetemplate);
        $validate = $request->validate([
            'title' => 'string|unique:message_templates,title,' . $messagetemplate->message_template_id . ',message_template_id',
            'message' => 'string'
        ]);

        //$this->authorize('update', $messagetemplate);

        if($request->has('title'))
            $messagetemplate->title = $request->title;

        if($request->has('message'))
            $messagetemplate->message = $request->message;


        if(!$messagetemplate->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        
        $messagetemplate->save();

        return $this->showOne($messagetemplate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageTemplate $messagetemplate)
    {
        $this->authorize('delete', $messagetemplate);
        
        $messagetemplate->delete();
        return $this->showOne($messagetemplate);
    }
}
