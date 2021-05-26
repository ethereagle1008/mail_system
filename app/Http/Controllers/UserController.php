<?php
namespace App\Http\Controllers;

use App\Character;
use App\Mail;
use App\PointList;
use App\PointPrice;
use App\Question;
use App\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function landing(){
        return view('user/landing');
    }

    public function teacherRank(){
        $characters = Character::orderBy('ranking', 'asc')->get();
        return view('user/teacher-rank', [
            'characters' => $characters
        ]);
    }
    public function modifyProfile(){
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->get()->first();
        $regions = Region::all();
        $email = $user->email;
        $email_arr = explode('@', $email);
        $user->email_header = $email_arr[0];
        $user->email_type = '@' . $email_arr[1];
        return view('user/modify-profile', [
            'user' => $user,
            'regions' => $regions
        ]);
    }
    public function modifyProfilePost(Request $request){
        $photo = null;
        if($request->hasFile('photo')){
            $photo = $request->photo->store('question','public');
        }
        if($photo == null) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'gender'=>(int)$request->gender,
                'birth'=>date('Y-m-d', strtotime($request->birth)),
                'height'=>$request->height,
                'region'=>$request->region,
            ];
        }
        else{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'gender'=>(int)$request->gender,
                'birth'=>date('Y-m-d', strtotime($request->birth)),
                'height'=>$request->height,
                'region'=>$request->region,
                'image'=>$photo?asset('storage')."/".$photo:null,
            ];
        }
        User::where('id', $request->user_id)->update($data);
        return $this->modifyProfile();
    }
    public function teacherConfirm(Request $request){
        $photo = null;
        if($request->hasFile('photo')){
            $photo = $request->photo->store('question','public');
        }
        $user = Auth::user();
        $point = $user->point;
        $character = Character::find($request->character_id);
        $need_point = false;
        if($point<$character->decreasing_point)
            $need_point = true;

        $info = [
            'question_id' => $request->question_id,
            'character_id'=>$request->character_id,
            'character_name' => $character->name,
            'question_content'=>$request->question_content,
            'image_url'=>$photo?asset('storage')."/".$photo:null,
            'need_point' => $need_point
        ];
        return view('user/teacher-confirm', [
            'info' => $info
        ]);
    }
    public function teacherChat($teacher_id){
        $character = Character::where('id', $teacher_id)->get()->first();
        return view('user/teacher-chat', [
            'character' => $character
        ]);
    }
    public function userReply($question_id){
        $question = Question::leftjoin('characters', 'characters.id', '=', 'questions.character_id')->where('questions.id', $question_id)->get()->first();
        return view('user/user-reply', [
            'question' => $question
        ]);
    }

    public function send_chat(Request $request){
        date_default_timezone_set('Asia/Tokyo');
        try{
            $user = Auth::user();
            $point = $user->point;
            $character = Character::find($request->character_id);
            if($point<$character->decreasing_point)
                return redirect('/teacher-chat/'.$request->character_id)->withErrors(['あなたは十分なポイントを持っていません。']);

            $data = [
                'user_id'=>$user->id,
                'character_id'=>$request->character_id,
                'content'=>$request->question_content,
                'type'=>'user_sent',
                'receive_date'=>date('Y-m-d H:i:s'),
                'image_url'=>$request->image_url
            ];
            Question::create($data);
            if(isset($request->question_id)){
                Question::where('id', $request->question_id)->update(['reply' => '1']);
            }
            Log::warning('$user->save()');
            $user->point = $point-$character->decreasing_point;
            $user->save();
            return response()->json([
                'status' => true
            ]);
        }catch (\Exception $e){
            Log::info("question error:".$e->getMessage());
            return redirect('/teacher-chat/'.$request->character_id)->withErrors(['サーバーにエラーがあります。']);
        }
    }

    public function terms(){
        return view('user/terms');
    }
    //question page
    public function question(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();
        return view('user/question', [
            'unique_id' => $user->unique_id,
        ]);
    }
    public function send_question(Request $request){
        date_default_timezone_set('Asia/Tokyo');
        try{
            $user = Auth::user();
            $data = [
                'user_id'=>$user->id,
                'character_id'=>8,
                'content'=>$request->question_content,
                'type'=>'user_sent',
                'receive_date'=>date('Y-m-d H:i:s')
            ];
            Question::create($data);
            return redirect('/mail-list');
        }catch (\Exception $e){
            Log::info("question error:".$e->getMessage());
            return redirect()->back()->withErrors(['サーバーにエラーがあります。']);
        }

    }

    public function myPage(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->first();
        $name = $user->name;
        $id = $user->unique_id;
        $point = $user->point;
        $questions = Question::leftjoin('characters', 'characters.id', '=', 'questions.character_id')->select(DB::raw('characters.*, questions.*, questions.id as q_id'))->where('receive_date', '<', date('Y-m-d H:i:s'))->where('user_id', $user_id)->where('type', 'character_sent')->orderBy('receive_date', 'desc')->get();
        $mail_list = array();
        foreach ($questions as $index => $question){
            if($index<5){
                $receive_date = $question->receive_date;
                if($receive_date){
                    $startDate = date('Y.m.d', strtotime($receive_date));
                    $question->receive_date = $startDate;
                }
                array_push($mail_list, $question);
            }
        }
        $character_list = array();
        $characters = Character::orderBy('ranking', 'asc')->get();
        foreach ($characters as $index => $character){
            if($index < 3){

                array_push($character_list, $character);
            }
        }
        return view('user/my-page', [
            'name' => $name,
            'id' => $id,
            'point' => $point,
            'mails' => $mail_list,
            'characters' => $character_list
        ]);
    }
    public function mailList(){
        $user_id = session()->get(SESS_UID);
        Question::where('user_id',$user_id)->where('receive_date', '<', date('Y-m-d H:i:s'))->where('status','unread')->update(['status'=>'read']);
        $mails = Question::leftjoin('characters', 'characters.id', '=', 'questions.character_id')->where('receive_date', '<', date('Y-m-d H:i:s'))->leftjoin('users', 'users.id', '=', 'questions.user_id')->where('user_id', $user_id)->select(DB::raw('characters.name as c_name, users.name as name, questions.receive_date as receive_date, questions.type as type, questions.id as id'))->orderBy('receive_date', 'desc')->paginate(10);
        $result = Question::leftjoin('characters', 'characters.id', '=', 'questions.character_id')->where('receive_date', '<', date('Y-m-d H:i:s'))->leftjoin('users', 'users.id', '=', 'questions.user_id')->where('user_id', $user_id)->select(DB::raw('characters.name as c_name, users.name as name, questions.receive_date as receive_date, questions.type as type, questions.id as id'))->orderBy('receive_date', 'desc')->get()->count();

        $pagination_params = [
            'result' => $result,
            'per_page' => 10,
        ];
        return view('user/mail-list', compact('pagination_params'), [
            'mails' => $mails
        ]);
    }
    public function pointList(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();
        return view('user/point-list', [
            'name' => $user->name,
            'point' => $user->point
        ]);
    }
    public function atmPay(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();
        $point_prices = PointPrice::orderBy('price', 'asc')->get();
        return view('user/atm-pay', [
            'unique_id' => $user->unique_id,
            'point' => $user->point,
            'point_prices' => $point_prices
        ]);
    }
    public function creditPay(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();

        return view('user/credit-pay', [
            'unique_id' => $user->unique_id,
            'point' => $user->point
        ]);
    }
    public function creditTel(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();
        $point_prices = PointPrice::orderBy('price', 'asc')->get();
        return view('user/credit-tel', [
            'unique_id' => $user->unique_id,
            'point' => $user->point,
            'point_prices' => $point_prices
        ]);
    }
    public function creditTelFinal(Request $request){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();
        $price = $request->select_price;
        $point = PointPrice::where('price', $price)->get()->first()->point;
        return view('user/credit-tel-final', [
            'unique_id' => $user->unique_id,
            'price' => $price,
            'point' => $point
        ]);
    }
    public function creditPc(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();
        $point_prices = PointPrice::orderBy('price', 'asc')->get();
        return view('user/credit-pc', [
            'unique_id' => $user->unique_id,
            'point_prices' => $point_prices
        ]);
    }

    public function pay(Request $request){
        date_default_timezone_set('Asia/Tokyo');
        $user_id = session()->get(SESS_UID);
        $data = [
            'user_id'=>$user_id,
            'point'=> $request->point,
            'price'=>$request->price,
            'pay_type'=>$request->pay_type,
            'date'=>date('Y-m-d H:i:s'),
            'month' => date('Y-m'),
            'day' => date('Y-m-d'),
            'hour' => date('Y-m-d H')
        ];
        PointList::create($data);
        $point = User::where('id', $user_id)->get()->first()->point;
        $point = $point + $request->point;
        User::where('id', $user_id)->update(['point' => $point]);
        return redirect('/point-list');
    }
    public function bankPort(){
        $user_id = session()->get(SESS_UID);
        $user = User::where('id', $user_id)->get()->first();
        sendBankPort(BANK_PORT, $user->email);
        return view('user/bank-port', [
            'unique_id' => $user->unique_id,
        ]);
    }



}
