<?php

namespace App\Http\Controllers\User;

use App\Country;
use App\Currency;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Partner;
use App\State;
use App\Title;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;

class UserController extends ApiBaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::
            where('type', User::REGULAR_USER)
            ->orWhere('type', User::ADMIN_USER)
            ->get();

        return $this->showAll($users);
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
        $this->validateUser($request);

        $allData = $request->all();

        $userData = $this->separateUserData($allData);

        $user = User::create($userData);

        if($allData['user_type'] == 'partner')
        {
            $partner = $this->separatePartnerData($allData, $user);

            $partner = Partner::create($partnerData);

            return $this->showOne($user->merge($partner), 201);
        }

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
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
    public function update(Request $request, User $user)
    {
        $rules = [

            'email' => 'email|unique:users, email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];

        //$this->validate($request, $rules);

        if($request->has('name'))
            $user->name = $request->name;

        if($request->has('email'))
            $user->email = $request->email;

        if($request->has('password'))
            $user->password = bcrypt($request->password);

        //For update of the admin field, if the user in session is not an admin, it should not update it.


        if(!$user->isDirty())
        {
            return $this->errorResponse('No field has been updated', 422);
        }

        $user->save();

        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->showOne($user);
    }


    private function validateUser(Request $request)
    {
        $rules = [];

        //If it's an inhouse user registering
        if($request->user_type == 'user')
        {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'type' => 'required|in:' . User::REGULAR_USER, User::ADMIN_USER,
                'branch' => 'required|in:' . User::LAGOS_BRANCH, User::SOUTH_AFRICA_BRANCH, User::GHANA_BRANCH,
                'password' => 'required|min:6|confirmed',
            ];
        }
        else
        {
           $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'title_id' => 'required|in:' . Title::all(),
                'state_id' => 'nullable|in:' . State::all(),
                'currency_id' => 'required|in:' . Currency::all(),
                'sex' => 'required|in:' . Partner::MALE, Partner::FEMALE,
                'date_of_birth' => 'required|date',
                'marital_status' => 'required|in:' . Partner::SINGLE_MARITAL_STATUS, Partner::MARRIED_MARITAL_STATUS, Partner::DIVORCED_MARITAL_STATUS,
                'occupation' => 'required',
                'preflang' => 'required|in:'. Partner::ENGLISH_PREFERRED_LANGUAGE, Partner::FRENCH_PREFERRED_LANGUAGE, Partner::SPANISH_PREFERRED_LANGUAGE,
                'birth_country' => 'required|in:' . Country::all(),
                'residential_country' => 'required|in:' . Country::all(),
                'email2' => 'nullable|email',
                'phone' => 'required',
                'phone2' => 'nullable',
                'residential_address' => 'required',
                'postal_address' => 'required',
                'donation_amount' => 'numeric|min:5000.00',
                'password' => 'required|min:6|confirmed',
            ]; 

        }

        //If an inhouse user is registering a partner
        if($request->registration_source == 'user_register_partner')
        {
            $rules = [
                'email' => 'email|unique:users|required_if:phone,' . null,
                'phone' => 'unique:users|required_if:email,' . null,
            ];

        }

        $this->validate($request, $rules);
    }

    private function separateUserData(Collection $allData)
    {

        $allData['password'] = bcrypt($request->password);

        $userData = [
            'name' => $allData['name'], 
            'email' => $allData['email'],
            'branch' => null,
            'type' => User::PARTNER_USER,
            'verification_token' => User::generateVerificationCode(),
            'verified' => User::UNVERIFIED_USER,
            'password' => $allData['password'],
        ];

        if($allData['registration_source'] == 'user_register_partner')
        {
            $userData = [
                'branch' => null,
            ];
        }

        if($allData['registration_source' == 'user_register_user'])
        {
            $userData = [
                'branch' => $allData['branch'],
                'type' => User::REGULAR_USER,
            ];
        }

        return $userData;
    }

    private function separatePartnerData(Collection $collection, User $user)
    {
        $partnerData = [
            'partner_id' => null,
            'user_id' => $user->user_id,
            'registered_by' => $allData['registered_by'],
            'title_id' => $allData['title_id'],
            'state_id' => $allData['state_id'],
            'currency_id' => $allData['currency_id'],
            'sex' => $allData['sex'],
            'date_of_birth' => $allData['date_of_birth'],
            'marital_status' => $allData['marital_status'],
            'occupation' => $allData['occupation'],
            'preflang' => $allData['preflang'],
            'birth_country' => $allData['birth_country'],
            'residential_country' => $allData['residential_country'],
            'email2' => $allData['email2'],
            'phone' => $allData['phone'],
            'phone2' => $allData['phone2'],
            'residential_address' => $allData['residential_address'],
            'postal_address' => $allData['postal_address'],
            'donation_amount' => $allData['donation_amount'],
        ];

        return $partnerData;
    }
}
