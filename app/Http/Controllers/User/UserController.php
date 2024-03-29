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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class UserController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('client.credentials:')->only(['resend', 'login']);

        $this->middleware('auth:api')->except(['resend', 'verify', 'login']);

        $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);
    }

    public function login(Request $request){

        $credentials = $request->validate([

            'email' => 'required|email',
            'password' => 'required'
        ]);

            if(Auth::attempt($credentials)){

                if(Auth::user()['type'] != User::ADMIN_USER && Auth::user()['type'] != User::REGULAR_USER)
                    return $this->errorResponse('Unauthenticated', 401);

                $client = new \GuzzleHttp\Client;

                $response = $client->post(config('app.url').'/oauth/token', [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => $request->password_client_id,
                        'client_secret' => $request->password_client_secret,
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*',
                    ],
                ]);

                return $this->successResponse(['user' => Auth::user(), 'token' => json_decode((string) $response->getBody(), true)], 200);
            }

            else
                return $this->errorResponse('Unauthenticated', 401);

    }

    public function logout()
    { 
        if (Auth::check()){
           Auth::user()->AauthAcessToken()->delete();
        }

        return $this->successResponse(null, 204);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

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
        $this->authorize('create');

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'branch' => 'required|in:' . User::LAGOS_BRANCH, User::GHANA_BRANCH, User::SOUTH_AFRICA_BRANCH,
            'type' => 'required|in:' . User::REGULAR_USER, User::ADMIN_USER,
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::VERIFIED_USER;
        $data['status'] = User::ACTIVE_USER;
        //$data['type'] = User::REGULAR_USER;
        //$data['verification_token'] = User::generateVerificationCode();

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
        $this->authorize('view', $user);

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
        $this->authorize('update', $user);

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
        $this->authorize('delete', $user);

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


    //Comments made by a partner
    public function comments(User $user)
    {
        $this->authorize('comments', $user);

        $comments = $user->comments_made_by;

        return $this->showAll($comments);
    }
    
}
