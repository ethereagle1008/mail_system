<?php

namespace App\Http\Controllers\Auth;

use App\AdAccessTime;
use App\AdRegisterTime;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Region;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';
    protected $ad_code;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $photo = null;
        if(isset($data['photo'])){
            $photo = $data['photo']->store('question','public');
        }

        $new_user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => $photo?asset('storage')."/".$photo:null,
            'unique_id' => rand(1000000,9999999),
            'gender'=>$data['gender'],
            'birth'=>date('Y-m-d', strtotime($data['birth'])),
            'marry'=>$data['marry'],
            'region'=>$data['region'],
            'ad_code' => isset($data['ad_code']) ? $data['ad_code'] : ''
        ]);

        return $new_user;
    }

    protected function showRegistrationForm()
    {
        $regions = Region::all();
        return view('auth.register',compact('regions'));
    }

    public function registered(Request $request, $user)
    {
        try{
            $random = rand(100000, 999999);
            sendVerifyEmail($random,$user->email);
            $user->verification_code = $random;
            $user->save();
        }catch (\Throwable  $exception) {
            Log::info("not:".$exception);
        }
    }
}
