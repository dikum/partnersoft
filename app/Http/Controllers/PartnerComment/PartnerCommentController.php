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

        //$this->middleware('transform.input:' . PartnerCommentTransformer::class)->only(['store', 'update']);
        $this->middleware('transform.input:' . PartnerCommentTransformer::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', PartnerComment::class);

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
        $this->authorize('create');

        $rules = [
            'made_by' => 'required',
            'to' => 'required|exists.users',
            'comment' => 'required|exists.users',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $comment = PartnerComment::create($data);

        return $this->showOne($comment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PartnerComment $comment)
    {
        $this->authorize('view', $comment);

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
        $this->authorize('update', $comment);

        if($request->has('made_by'))
        {
            return $this->errorResponse('Sorry, creator of this comment cannot be updated', 409);
        }

        if($request->has('to'))
        {
            return $this->errorResponse('Sorry, this recipient of this comment cannot be updated', 409);
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
        $this->authorize('delete', $comment);

        $comment->delete();
        return $this->showOne($comment);
    }

}
