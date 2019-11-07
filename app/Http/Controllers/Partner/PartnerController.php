<?php

namespace App\Http\Controllers\Partner;

use App\Country;
use App\Currency;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\State;
use Illuminate\Http\Request;

class PartnerController extends ApiBaseController
{
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
        $rules = [
            //Title
            'title_id' => 'required',

            //Partner
            'surname' => 'required',
            'middle_name' => 'nullable',
            'first_name' => 'required',
            'sex' => 'required',
            'date_of_birth' => 'required',
            'marital_status' => 'required',
            'occupation' => 'required',
            'note' => 'nullable',
            'preflang' => 'required',
            'password' => 'required|min:6|confirmed',

            //Contact
            'birth_country' => 'required', //Country ID
            'residential_country' =>'required', //Country ID
            'state_id' => 'required',
            'email' => 'required|email|unique:partners',
            'email2' => 'nullable|email',
            'phone' => 'required',
            'phone2' => 'nullable',
            'residential_address' => 'required',
            'postal_address' => 'required',

            //Pledge
            'currency_id' => 'required',
            'donation_type' => 'required',
            'donation_amount' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = Partner::UNVERIFIED_PARTNER;
        $data['partner_id'] = Partner::PARTNER_ID;
        $data['status'] = Partner::PENDING_STATUS;
        $data['registered_by'] = Partner::REGISTERED_BY_SELF;
        $data['verification_token'] = Partner::generateVerificationCode();

        $partner = Partner::create($data);

        return response()->json(['data'=>$partner], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = Partner::findOrFail($id);

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
    public function update(Request $request, $id)
    {

        $partner = Partner::findOrFail($id);

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
            return response()->json(['error' => 'Sorry, the Partnership ID field cannot be updated', 'code' => 409], 409);
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

        if($request->has('note'))
            $partner->note = $request->note;

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
            return response()->json(['error' => 'No field has been updated', 'code' => 422], 422);
        }

        $partner->save();

        return response()->json(['data' => $partner], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return response()->json(['data' => $partner], 200);
    }
}
