<?php

namespace App\Http\Controllers\Title;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Title;
use App\Transformers\TitleTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\dd;

class TitleController extends ApiBaseController
{

    public function __construct()
    {

        $this->middleware('auth:api');

        $this->middleware('transform.input:' . TitleTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = Title::all();

        return $this->showAll($titles);
        //dd($titles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $title = Title::create($data);

        return $this->showOne($title, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        return $this->showOne($title);
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
    public function update(Request $request, Title $title)
    {
        if($request->has('title'))
            $title->title = $request->title;

        if(!$title->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        $title->save();

        return $this->showOne($title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        $title->delete();
        return $this->showOne($title);
    }
}
