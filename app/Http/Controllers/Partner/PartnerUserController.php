<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\User;
use Illuminate\Http\Request;

class PartnerUserController extends ApiBaseController
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
    public function index(Partner $partner)
    {
        $user = User::where('user_id', $partner->user_id)->get();

        return $this->showAll($user);
    }
}
