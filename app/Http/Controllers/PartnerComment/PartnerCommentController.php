<?php

namespace App\Http\Controllers\PartnerComment;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\PartnerComment;
use App\Transformers\PartnerCommentTransformer;
use Illuminate\Http\Request;

class PartnerCommentController extends ApiBaseController
{

    public function __construct()
    {

        $this->middleware('auth:api');

        $this->middleware('transform.input:' . PartnerCommentTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $comments = PartnerComment::all();

         return $this->showAll($comments);
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

        return $this->showOne($sms, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PartnerComment $comment)
    {
        return $this->showOne($comment);
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
    public function update(Request $request, PartnerComment $comment)
    {

        if($request->has('partner_id'))
        {
            return $this->errorResponse('Sorry, the Partnership ID field cannot be updated', 409);
        }

        if($request->has('user_id'))
        {
            return $this->errorResponse('Sorry, the User ID field cannot be updated', 409);
        }

        if($request->has('comment'))
            $comment->comment = $request->comment;

        if(!$comment->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        $comment->save();

        return $this->showOne($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnerComment $comment)
    {
        $comment->delete();
        return $this->showOne($comment);
    }
}
