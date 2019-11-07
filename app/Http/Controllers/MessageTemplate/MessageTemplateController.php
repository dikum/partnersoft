<?php

namespace App\Http\Controllers\MessageTemplate;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\MessageTemplate;
use Illuminate\Http\Request;

class MessageTemplateController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data'=>MessageTemplate::all()]);
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

        return response()->json(['data'=>$message], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = MessageTemplate::findOrFail($id);

        return response()->json(['data'=>$message], 200);
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
        $message_template = MessageTemplate::findOrFail($id);

        //$this->validate($request, $rules);

        if($request->has('title'))
            $message_template->title = $request->title;

        if($request->has('message'))
            $message_template->message = $request->message;


        if(!$message_template->isDirty())
        {
            return response()->json(['error' => 'No field has been updated', 'code' => 422], 422);
        }

        $message_template->save();

        return response()->json(['data' => $message_template], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message_template = MessageTemplate::findOrFail($id);
        $message_template->delete();
        return response()->json(['data' => $message_template], 200);
    }
}
