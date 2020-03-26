<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\dd;

class PartnerPaymentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($partner_id)
    {
        $partner = User::where('user_id', $partner_id)->firstOrFail();

        $payments = $partner->payments()->with('bank_statement')->get();
        
        return $this->showAll($payments);
    }
}
