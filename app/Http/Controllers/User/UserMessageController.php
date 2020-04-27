<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserMessageController extends ApiBaseController
{

    public function __construct()
    {

        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $emails = $user->emails_sent_by;
        $sms = $user->sms_sent_by;

        $messages = $sms->merge($emails);

        return $this->showAll($messages);
    }
}
