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
        $this->middleware('client.credentials:')->only(['resend']);

        $this->middleware('auth:api')->except(['resend', 'verify']);

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
            where('type', '!=', User::PARTNER_USER)
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'branch' => 'required|in:' . User::LAGOS_BRANCH, User::GHANA_BRANCH, User::SOUTH_AFRICA_BRANCH,
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['status'] = User::INACTIVE_USER;
        $data['type'] = User::REGULAR_USER;
        $data['verification_token'] = User::generateVerificationCode();

        $user = User::create($data);

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

        if($user->type != User::PARTNER_USER)
            return $this->showOne($user);

        return $this->errorResponse('User not found', 404);
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
            'branch' => 'in:' . User::LAGOS_BRANCH, User::GHANA_BRANCH, User::SOUTH_AFRICA_BRANCH, 
            'type' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
            'status' => 'in:' . User::ACTIVE_USER . ',' . User::INACTIVE_USER,
        ];

        $this->validate($request, $rules);

        
        if($request->has('name'))
            $user->name = $request->name;

        if($request->has('email'))
        {
            $user->email = $request->email;
            $data['verification_token'] = User::generateVerificationCode();
            $data['verified'] = User::UNVERIFIED_USER;
        }

        if($request->has('branch'))
            $user->branch = $request->branch;

        if($request->has('type'))
            $user->type = $request->type;

        if($request->has('status'))
            $user->branch = $request->status;

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

     public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = User::VERIFIED_PARTNER;
        $user->verification_token = null;

        $user->save();

        return $this->showMessage("Account Verified");
    }

    public function resend(User $user)
    {
        if($user->isVerified())
            return $this->errorResponse('User is already verified', 409);

        Mail::to($user->email)->send(new UserCreated($user));

        return $this->showMessage('Verification link resent!');
    }
    
}
