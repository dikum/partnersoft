<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use Illuminate\Http\Request;

class PartnerMessageController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Partner $partner)
    {
        $sms = $partner->sms;
        $emails = $partner->emails;

        $messages = $sms->merge($emails);
        
        return $this->showAll($messages);
    }
}
