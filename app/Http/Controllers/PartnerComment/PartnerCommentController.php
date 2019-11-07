<?php

namespace App\Http\Controllers\PartnerComment;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\PartnerComment;
use Illuminate\Http\Request;

class PartnerCommentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return response()->json(['data'=>PartnerComment::all()], 200);
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
            'comment' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $sms = Sms::create($data);

        return response()->json(['data'=>$sms], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = PartnerComment::findOrFail($id);

        return response()->json(['data'=>$comment], 200);
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
        $comment = PartnerComment::findOrFail($id);

        if($request->has('partner_id'))
        {
            return response()->json(['error' => 'Sorry, the Partnership ID field cannot be updated', 'code' => 409], 409);
        }

        if($request->has('comment'))
            $comment->comment = $request->comment;

        if(!$comment->isDirty())
        {
            return response()->json(['error' => 'No field has been updated', 'code' => 422], 422);
        }

        $comment->save();

        return response()->json(['data' => $comment], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = PartnerComment::findOrFail($id);
        $comment->delete();
        return response()->json(['data' => $comment], 200);
    }
}
