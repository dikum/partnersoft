<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserCommentController extends ApiBaseController
{
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
