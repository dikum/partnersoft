<?php

namespace App\Http\Controllers\Partner;

use App\Country;
use App\Currency;
use App\Helpers\CountryHelper;
use App\Helpers\CurrencyHelper;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Mail\PartnerCreated;
use App\Partner;
use App\Rules\PledgeAmount;
use App\State;
use App\Title;
use App\Transformers\PartnerTransformer;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PartnerController extends ApiBaseController
{


    public function __construct()
    {
        //$this->middleware('client.credentials:read-partner')->only(['store', 'show']); //Routes that can be accessed with client credentials
        //$this->middleware('client.credentials')->only(['store', 'show']); //Routes that can be accessed with client credentials

        //$this->middleware('auth:api')->except(['store', 'show']);   //Routes that need a valid access token

        $this->middleware('auth:api')->except(['store']);

        $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);

        //$this->middleware('can:view,user')->only(['show']);

        //$this->middleware('scope:read-partner')->only(['store', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('view-partners'))
        {
            $branch = auth()->user()->branch;
            $type = auth()->user()->type;

            if($type == User::ADMIN_USER || $branch == 'lagos')
                $partners = User::
                    where('type', User::PARTNER_USER)
                    ->get();
            else
                $partners = User::
                    where('type', User::PARTNER_USER)
                    ->where('branch', $branch)
                    ->get();

            return $this->showAll($partners);
        }

        return $this->errorResponse('Sorry, This action is not authorized', 403);
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
            'title_id' => 'required|exists:titles',
            'state_id' => 'exists:states',
            'currency_id' => 'exists:currencies',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'email2' => 'email',
            'phone' => 'required|unique:users',
            'sex' => 'required|in:' . User::MALE . ',' . User::FEMALE,
            'date_of_birth' => 'required|date',
            'marital_status' => 'required|in:([' . User::SINGLE_MARITAL_STATUS . ',' . User::MARRIED_MARITAL_STATUS . ',' . User::DIVORCED_MARITAL_STATUS . '])',
            'occupation' => 'required',
            'donation_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'birth_country' => 'required|exists:countries,country_id',
            'residential_country' => 'required|exists:countries,country_id',
            'residential_address' => 'required',
            'preflang' => 'required|in:' . User::ENGLISH_PREFERRED_LANGUAGE . ',' . User::FRENCH_PREFERRED_LANGUAGE . ',' . User::SPANISH_PREFERRED_LANGUAGE,
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $country_name = CountryHelper::get_country_name($data['residential_country']);
        $currency_name = CurrencyHelper::get_currency_name($data['currency_id']);

        if($country_name == 'Ghana')
            $data['branch'] = User::GHANA_BRANCH;
        else
            if($country_name == 'South Africa' || $currency_name == 'ZAR')
                $data['branch'] = User::SOUTH_AFRICA_BRANCH;
            else
                $data['branch'] = User::LAGOS_BRANCH;



        $data['partner_id'] = null;
        $data['donation_type'] = User::EMMANUELTV;
        $data['registered_by'] = null;
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['status'] = User::INACTIVE_USER;
        $data['type'] = User::PARTNER_USER;
        $data['verification_token'] = User::generateVerificationCode();

        $partner = User::create($data);

        return $this->showOne($partner, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($partner_id)
    {
        $branch = auth()->user()->branch;
        $type = auth()->user()->type;

        $partner = User::findOrFail($partner_id);

        if(Gate::allows('view-partner', $partner))
        {
            if($type == User::ADMIN_USER || $branch == User::LAGOS_BRANCH || $branch == $partner->branch)
                return $this->showOne($partner);
            return $this->errorResponse('Sorry, This action is not authorized', 403);
        }
        
        return $this->errorResponse('Sorry, This action is not authorized', 403);
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
    public function update(Request $request, $partner_id)
    {

        $partner = User::findOrFail($partner_id);

        if(Gate::denies('update-partner', $partner))
            return $this->errorResponse('Sorry, This action is not authorized', 403);


        $validate = $request->validate([
            'partner_id' => 'nullable',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $partner->user_id .  ',user_id',
            'email2' => 'nullable|email',
            'phone' => 'required|unique:users,phone,' . $partner->user_id . ',user_id',
            'phone2' => 'nullable',
            'postal_address' => 'nullable',
            //'password' => 'required|min:6|confirmed',
            'title_id' => 'required|exists:titles',
            'state_id' => 'nullable|exists:states',
            'currency_id' => 'required|exists:currencies',
            'sex' => 'required|in:' . User::MALE . ',' . User::FEMALE,
            'date_of_birth' => 'required|date',
            'marital_status' => 'required|in:' . User::DIVORCED_MARITAL_STATUS . ',' . User::MARRIED_MARITAL_STATUS . ',' . User::SINGLE_MARITAL_STATUS,
            'preflang' => 'required|in:' . User::ENGLISH_PREFERRED_LANGUAGE . ',' . User::SPANISH_PREFERRED_LANGUAGE . ',' . User::FRENCH_PREFERRED_LANGUAGE,
            'birth_country' => 'required|exists:countries,country_id',
            'residential_country' => 'required|exists:countries,country_id',
            'donation_amount' => ['required', 'regex:/^\d+(\.\d{1,2})?$/', new PledgeAmount($request->currency_id, $request->title_id)]
            //'donation_type' => 'in:' . User::EMMANUELTV . ',' . User::DONATION,
        ]);


        if($request->has('email'))
        {
            $partner->verified = User::UNVERIFIED_USER;
            $partner->verification_token = User::generateVerificationCode();
            $partner->email = $request->email;
        }

        if($request->has('email2'))
            $partner->email2 = $request->email2;

        if($request->has('title_id'))
            $partner->title_id = $request->title_id;

        if($request->has('state_id'))
            $partner->state_id = $request->state_id;

        if($request->has('currency_id'))
            $partner->currency_id = $request->currency_id;

        if($request->has('name'))
            $partner->name = $request->name;

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

        if($request->has('branch'))
            $partner->branch = $request->branch;

        if($request->has('registered_by'))
            $partner->registered_by = $request->registered_by;

        $partner->donation_type = User::EMMANUELTV;

        if(!$partner->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        $partner->save();

        return $this->showOne($partner);
        //dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($partner_id)
    {
        $partner = User::findOrFail($partner_id);

        if(Gate::denies('view-partner', $partner))
            return $this->errorResponse('Sorry, This action is not authorized', 403); 

        $partner->delete();
        return $this->showOne($partner);
    }


    //Comments made on a partner
    public function comments($partner_id)
    {

        $partner = User::where('user_id', $partner_id)->firstOrFail();
        if(Gate::denies('view-partner', $partner))
            return $this->errorResponse('Sorry, This action is not authorized', 403);

        $comments = $partner->comments;

        return $this->showAll($comments);
    }

}
