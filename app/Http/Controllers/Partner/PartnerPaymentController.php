<?php

namespace App\Http\Controllers\Partner;

use App\BankStatement;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\dd;

class PartnerPaymentController extends ApiBaseController
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
    public function index($partner_id)
    {
        $this->authorize('view-payments', Partner::class);

        $payments = Payment::where('made_by', $partner_id)->get();

        return $this->showAll($payments);
    }
}
