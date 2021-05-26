<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm(){
        return view('auth.forget_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $email = $request->email;
        $exist = User::where('email',$email)->first();
        if($exist){
            DB::table('password_reset')->where('email',$email)->delete();
            DB::table('password_reset')->insert([
                'email' => $email,
                'token' => generateRandomString(60),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $tokenData = DB::table('password_reset')
                ->where('email', $email)->orderBy('created_at','DESC')->first()->token;
            try{
                sendResetEmail($tokenData,$email);
                return response(['result'=>true,'email_exist'=>true]);
            }catch (\Exception $e){
                Log::info("email error".$e->getMessage());
                return response(['result'=>false]);
            }
        }else{
            return response(['result'=>true,'email_exist'=>false]);
        }
    }
}
