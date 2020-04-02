<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserPaymentController extends ApiBaseController
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
    public function index(User $user)
    {
        $payments = $user->payments()->with('bank_statement')->get();

        return $this->showAll($payments);
    }
}
