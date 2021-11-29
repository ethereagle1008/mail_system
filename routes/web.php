<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define('SESS_UID',                  'SESS_CMS_USER_UID');
define('SESS_ADMIN_UID',                  'SESS_ADMIN_USER_UID');
define('BANK_PORT',                  'BANK_PORT_SEND');


Route::get('/', function () {
    return view('user.home');
});
Route::get('/home','HomeController@index')->name('home');

Route::get('/landing','UserController@landing')->name('landing');
//Route::get('/logout', 'HomeController@logout');
//Route::get('/auto-login','UserController@autoLogin');
Route::get('/login-insecure', 'Auth\LoginController@loginInsecure')->name('login.insecure');
//auth
Auth::routes();

Route::get('/email/verify','HomeController@verify_form')->name('email.verify');
Route::post('/email/check_code','HomeController@check_code')->name('email.check_code');
Route::post('/email/resend','HomeController@resend_code')->name('email.resend');


Route::get('/teacher-rank', 'UserController@teacherRank')->name('teacher-rank');
Route::get('/teacher-chat/{teacher_id}', 'UserController@teacherChat')->name('teacher-chat');
Route::get('/terms', 'UserController@terms')->name('terms');

//user
Route::group(['middleware'=>'checkUser'],function (){
    Route::get('/question', 'UserController@question')->name('question');
    Route::post('/question','UserController@send_question')->name('send_question');
    Route::post('/send_chat','UserController@send_chat')->name('send_chat');
    Route::get('/my-page', 'UserController@myPage')->name('my-page');
    Route::get('/point-list', 'UserController@pointList')->name('point-list');
    Route::get('/mail-list', 'UserController@mailList')->name('mail-list');
    Route::get('/atm-pay', 'UserController@atmPay')->name('atm-pay');
    Route::get('/credit-pay', 'UserController@creditPay')->name('credit-pay');
    Route::get('/credit-tel', 'UserController@creditTel')->name('credit-tel');
    Route::post('/credit-tel-final', 'UserController@creditTelFinal')->name('credit-tel-final');
    Route::get('/credit-pc', 'UserController@creditPc')->name('credit-pc');
    Route::get('/bank-port', 'UserController@bankPort')->name('bank-port');
    Route::get('/user-reply/{question_id}', 'UserController@userReply')->name('user-reply');
    Route::post('/teacher-confirm', 'UserController@teacherConfirm')->name('teacher-confirm');
    Route::post('/pay', 'UserController@pay')->name('pay');
    Route::get('/modify-profile', 'UserController@modifyProfile')->name('modify-profile');
    Route::post('/modify-profile', 'UserController@modifyProfilePost')->name('modify-profile');
});

