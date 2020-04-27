<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\User;
use Illuminate\Http\Request;

class PartnerMessageController extends ApiBaseController
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
        $this->authorize('view-messages', Partner::class);
        $partner = User::where('user_id', $partner_id)->firstOrFail();
        $sms = $partner->sms_to;
        $emails = $partner->emails_to;

        $messages = $sms->merge($emails);
        
        return $this->showAll($messages);
    }
}
