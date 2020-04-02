<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserCommentController extends ApiBaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . BankTransformer::class)->only(['store', 'update']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $comments = $user->comments;

        return $this->showAll($comments);
    }
}
