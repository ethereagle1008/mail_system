<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if($user) {
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

        }else{
            return redirect('/');
        }
    }

    public function verify_form(){
        return view('auth.verify');
    }

    public function check_code(Request $request){
        $user = Auth::user();
        date_default_timezone_set('Asia/Tokyo');
        if($request->code==$user->verification_code){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
            return response()->json(['result'=>true,'success'=>true]);
        }
        else
            return response()->json(['result'=>true,'success'=>false]);
    }

    public function resend_code(Request $request){
        $user = Auth::user();
        try{
            $random = rand(100000, 999999);
            sendVerifyEmail($random,$user->email);
            $user->verification_code = $random;
            $user->save();
            return response()->json(['result'=>true,'success'=>false]);
        }catch (\Exception $e){
            Log::info("not:".$e);
            return response()->json(['result'=>false]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $this->guard()->logout();

        $request->session()->invalidate();

        // /homeに変更
        return $this->loggedOut($request) ?: redirect('/');
    }

//    public function logout()
//    {
//        session()->forget(SESS_UID);
//        session()->forget(SESS_ADMIN_UID);
//        return response()->json([
//            'status' => true,
//        ]);
//    }
}
