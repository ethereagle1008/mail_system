<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LoginLog;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticated(Request $request, $user)
    {
        LoginLog::create([
           'user_id'=>$user->id,
           'ip'=>$request->ip()
        ]);
        //auth()->logout();

//        print_r($request->type);
//        print_r($user->role);
//        die();

        if($request->type=="manage" && $user->role=="user"){
            auth()->logout();
            return redirect('/manage/login');
        }
        if($request->type=="user" && $user->role=="admin"){
           auth()->logout();
           return redirect('/login');
        }
//        if($user->role=="admin"){
//           return redirect('/manage/search-members');
//        }
        if($user->role=="admin") {
            session()->forget(SESS_UID);
            session()->put(SESS_ADMIN_UID, $user->id);
            return redirect('/manage/search-members');
        }
        else{
            session()->forget(SESS_ADMIN_UID);
            session()->put(SESS_UID, $user->id);
            return redirect('/my-page');
        }
    }

    public function loginInsecure(Request $request){
        $email = request()->email;
        $user = User::where('email', $email)->get()->first();
        Auth::login($user);
        LoginLog::create([
            'user_id'=>$user->id,
            'ip'=>$request->ip()
        ]);
        session()->forget(SESS_ADMIN_UID);
        session()->put(SESS_UID, $user->id);
        return redirect('/my-page');
    }
}
