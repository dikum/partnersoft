<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\User;
use Illuminate\Http\Request;

class PartnerMessageController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($partner_id)
    {
        $partner = User::where('user_id', $partner_id)->firstOrFail();
        $sms = $partner->sms;
        $emails = $partner->emails;

        $messages = $sms->merge($emails);
        
        return $this->showAll($messages);
    }
}
