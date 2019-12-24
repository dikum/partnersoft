<?php

namespace App\Http\Controllers\Partner;

use App\Country;
use App\Currency;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Mail\PartnerCreated;
use App\Partner;
use App\State;
use App\Transformers\PartnerTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PartnerController extends ApiBaseController
{


    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . PartnerTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all();

        return $this->showAll($partners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return $this->showOne($partner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {

        $rules = [
            'partner_id' => 'nullable',
            'email' => 'email|unique:partners, email,' . $partner->id,
            'email2' => 'nullable|email',
            'middle_name' => 'nullable',
            'note' => 'nullable',
            'phone2' => 'nullable',
            'postal_address' => 'nullable',
            'password' => 'min:6|confirmed',
            'title' => 'in:' . Partner::all(),
            'state_id' => 'nullable|in:' . State::all(),
            'currency_id' => 'in:' . Currency::all(),
            'sex' => 'in:' . Partner::MALE . ',' . Partner::FEMALE,
            'date_of_birth' => 'date',
            'marital_status' => 'in:' . Partner::DIVORCED_MARITAL_STATUS . ',' . Partner::MARRIED_MARITAL_STATUS . ',' . Partner::SINGLE_MARITAL_STATUS,
            'preflang' => 'in:' . Partner::ENGLISH_PREFERRED_LANGUAGE . ',' . Partner::SPANISH_PREFERRED_LANGUAGE . ',' . Partner::FRENCH_PREFERRED_LANGUAGE,
            'birth_country' => 'in:' . Country::all(),
            'residential_country' => 'in:' . Country::all(),
            'donation_type' => 'in:' . Partner::EMMANUELTV . ',' . Partner::DONATION,
        ];

        if($request->has('partner_id'))
        {
            return $this->errorResponse('Sorry, the Partnership ID field cannot be updated', 409);
        }

        if($request->has('email'))
        {
            $partner->verified = Partner::UNVERIFIED_PARTNER;
            $partner->verification_token = Partner::generateVerificationCode();
            $partner->email = $request->email;
        }

        if($request->has('email2'))
            $partner->email2 = $request->email2;

        if($request->has('title'))
            $partner->title = $request->title;

        if($request->has('state_id'))
            $partner->state_id = $request->state_id;

        if($request->has('currency_id'))
            $partner->currency_id = $request->currency_id;

        if($request->has('surname'))
            $partner->surname = $request->surname;

        if($request->has('middle_name'))
            $partner->middle_name = $request->middle_name;

        if($request->has('first_name'))
            $partner->first_name = $request->first_name;

        if($request->has('occupation'))
            $partner->occupation = $request->occupation;

        if($request->has('phone'))
            $partner->phone = $request->phone;

        if($request->has('phone2'))
            $partner->phone2 = $request->phone2;

        if($request->has('residential_address'))
            $partner->residential_address = $request->residential_address;

        if($request->has('postal_address'))
            $partner->postal_address = $request->postal_address;

        if($request->has('sex'))
            $partner->sex = $request->sex;

        if($request->has('date_of_birth'))
            $partner->date_of_birth = $request->date_of_birth;

        if($request->has('marital_status'))
            $partner->marital_status = $request->marital_status;

        if($request->has('preflang'))
            $partner->preflang = $request->preflang;

        if($request->has('birth_country'))
            $partner->birth_country = $request->birth_country;

        if($request->has('residential_country'))
            $partner->residential_country = $request->residential_country;

        if($request->has('donation_type'))
            $partner->donation_type = $request->donation_type;

        if($request->has('donation_amount'))
            $partner->donation_amount = $request->donation_amount;

        if($request->has('status'))
            $partner->status = $request->status;

        if($request->has('registered_by'))
            $partner->registered_by = $request->registered_by;

        if($request->has('email2'))
            $partner->email2 = $request->email2;

        if(!$partner->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        $partner->save();

        return $this->showOne($partner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return $this->showOne($partner);
    }

    public function verify($token)
    {
        $partner = Partner::where('verification_token', $token)->firstOrFail();

        $partner->verified = Partner::VERIFIED_PARTNER;
        $partner->verification_token = null;

        $partner->save();

        return $this->showMessage("Account Verified");
    }

    public function resend(Partner $partner)
    {
        if($partner->isVerified())
            return $this->errorResponse('Partner is already verified', 409);

        Mail::to($partner->email)->send(new PartnerCreated($partner));

        return $this->showMessage('Verification link resent!');
    }
}
