<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use Illuminate\Http\Request;

class PartnerRegisterController extends ApiBaseController
{

    public function __construct()
    {
        parent::__construct();
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Partner $partner)
    {
        $user = $partner->user;

        return $this->showAll($user);
    }
}
