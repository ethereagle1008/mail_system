<?php

namespace App\Console\Commands;

use App\AutoMessage;
use App\Character;
use App\LoginLog;
use App\Mail;
use App\PointList;
use App\Question;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendAutoMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send auto message';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Tokyo');
        $now = date('Y-m-d H:i') . ':00';
        $messages = AutoMessage::where('send_time', $now)->where('status', 1)->where('type', 1)->get();
        foreach ($messages as $message){
            AutoMessage::where('id', $message->id)->update(['status' => 0]);
            $search_param = [];
            $search_param['unique_id'] = explode(',', $message->unique_id);
            $search_param['name'] = $message->user_name;
            $search_param['gender'] = $message->gender;
            $search_param['start_age'] = $message->start_age;
            $search_param['end_age'] = $message->end_age;
            $search_param['start_count'] = $message->start_count;
            $search_param['end_count'] = $message->end_count;
            $search_param['start_money'] = $message->start_price;
            $search_param['end_money'] = $message->end_price;
            $search_param['start_last_money_day'] = $message->start_money;
            $search_param['end_last_money_day'] = $message->end_money;
            $search_param['start_point'] = $message->start_point;
            $search_param['end_point'] = $message->end_point;
            $search_param['start_last_login_day'] = $message->start_login;
            $search_param['end_last_login_day'] = $message->end_login;

            $members_origin = User::where('role', 'user')->where('name', 'like', '%'.$search_param['name'].'%');
            $members = $members_origin->get();
            foreach ($members as $index => $member){
                $birth = $member -> birth;
                $birthYear = date('Y', strtotime($birth));
                $cur_year = date("Y");
                $age = $cur_year - $birthYear;
                if(isset($search_param['unique_id'])){
                    if(!in_array($member->unique_id, $search_param['unique_id'])){
                        unset($members[$index]);
                        continue;
                    }
                }
                if(isset($search_param['gender'])){
                    if($member->gender != $search_param['gender']){
                        unset($members[$index]);
                        continue;
                    }
                }
                if(!empty($search_param['start_age'])){
                    if($age < $search_param['start_age']){
                        unset($members[$index]);
                        continue;
                    }
                }
                if(!empty($search_param['end_age'])){
                    if($age > $search_param['end_age']){
                        unset($members[$index]);
                        continue;
                    }
                }

                $buy_point = PointList::where('user_id', $member->id)->get();
                $cnt = $buy_point->count();


                if(!empty($search_param['start_count'])){
                    if($cnt < $search_param['start_count']){
                        unset($members[$index]);
                        continue;
                    }
                }
                if(!empty($search_param['end_count'])){
                    if($cnt > $search_param['end_count']){
                        unset($members[$index]);
                        continue;
                    }
                }

                $amount = 0;
                foreach ($buy_point as $buy){
                    $amount += $buy -> price;
                }

                if(!empty($search_param['start_money'])){
                    if($amount < $search_param['start_money']){
                        unset($members[$index]);
                        continue;
                    }
                }
                if(!empty($search_param['end_money'])){
                    if($amount > $search_param['end_money']){
                        unset($members[$index]);
                        continue;
                    }
                }

                if(!empty($search_param['start_last_money_day'])||!empty($search_param['end_last_money_day'])){
                    $last_buy = PointList::where('user_id', $member->id)->orderBy('date', 'desc')->get()->first();

                    if(!empty($search_param['start_last_money_day'])){
                        if(!isset($last_buy)){
                            unset($members[$index]);
                            continue;
                        }
                        if(date('Y-m-d', strtotime($last_buy->date)) < date('Y-m-d', strtotime($search_param['start_last_money_day']))){
                            unset($members[$index]);
                            continue;
                        }
                    }
                    if(!empty($search_param['end_last_money_day'])){
                        if(!isset($last_buy)){
                            unset($members[$index]);
                            continue;
                        }
                        if(date('Y-m-d', strtotime($last_buy->date)) > date('Y-m-d', strtotime($search_param['end_last_money_day']))){
                            unset($members[$index]);
                            continue;
                        }
                    }
                }

                if(!empty($search_param['start_point'])){
                    if($member->point < $search_param['start_point']){
                        unset($members[$index]);
                        continue;
                    }
                }
                if(!empty($search_param['end_point'])){
                    if($member->point > $search_param['end_point']){
                        unset($members[$index]);
                        continue;
                    }
                }

                if(!empty($search_param['start_last_login_day']) || !empty($search_param['end_last_login_day'])){
                    $last_login = LoginLog::where('user_id', $member->id)->orderBy('created_at', 'desc')->get()->first();

                    if(!empty($search_param['start_last_login_day'])){
                        if(!isset($last_login)){
                            unset($members[$index]);
                            continue;
                        }
                        if(date('Y-m-d', strtotime($last_login->created_at)) < date('Y-m-d', strtotime($search_param['start_last_login_day']))){
                            unset($members[$index]);
                            continue;
                        }
                    }
                    if(!empty($search_param['end_last_login_day'])){
                        if(!isset($last_login)){
                            unset($members[$index]);
                            continue;
                        }
                        if(date('Y-m-d',strtotime($last_login->created_at)) > date('Y-m-d', strtotime($search_param['end_last_login_day']))){
                            unset($members[$index]);
                            continue;
                        }
                    }
                }
            }
            foreach ($members as $member){
                $message_text = $message->content;
                $import = User::where('id', $member->id)->get()->first();

                $message_arr_tmp = explode('%', $message_text);
                $message_arr = $message_arr_tmp;
                foreach ($message_arr as $index => $str){

                    if ($str == "username") {
                        $message_arr[$index] = $import['name'];
                    }
                    if ($str == "usermail") {
                        $message_arr[$index] = $import['email'];
                    }
                    if ($str == 'userphone') {
                        $message_arr[$index] = $import['mobile'];
                    }
                    if ($str == 'userage') {
                        $birthYear = date('Y', strtotime($import['birth']));
                        $cur_year = date("Y");
                        $message_arr[$index] = $cur_year - $birthYear;
                    }
                    if ($str == 'userbirth') {
                        $message_arr[$index] = date('Y年m月d日', strtotime($import['birth']));
                    }
                    if ($str == 'userpref') {
                        $message_arr[$index] = $import['region'];
                    }
                    if ($str == 'usersex') {
                        if($import['gender'] == 0){
                            $message_arr[$index] = '男性';
                        }
                        else{
                            $message_arr[$index] = '女性';
                        }
                        //$message_arr[$index] = $import['gender'];
                    }
                }

                $content = '';
                foreach ($message_arr as $str){
                    $content = $content . $str;
                }
                $data = [
                    'character_id' => $message->character_id,
                    'user_id' => $member->id,
                    'content' => $content,
                    'type' => 'character_sent',
                    'receive_date'=>date('Y-m-d H:i:s'),
                    'image_url'=>$message->image
                ];

                $q_id = Question::create($data)->id;
                $mail_data = [
                    'question_id' => $q_id,
                    'user_id' => $member->id,
                    'content' => str_split($content, 20)[0],
                    'send_time' => date('Y-m-d H:i:s'),
                ];
                Mail::create($mail_data);
            }
        }
//
//        $now = time();
//        $ten_minutes = $now - 60;
//        $date = date('Y-m-d H:i', $ten_minutes);
//        $messages = AutoMessage::where('send_time', 'like', '%'.$date.'%')->where('status', 1)->where('type', 0)->get();
//        foreach ($messages as $message){
//            AutoMessage::where('id', $message->id)->update(['status' => 0]);
//            $search_param = [];
//            $search_param['unique_id'] = $message->unique_id;
//            $search_param['name'] = $message->user_name;
//            $search_param['gender'] = $message->gender;
//            $search_param['start_age'] = $message->start_age;
//            $search_param['end_age'] = $message->end_age;
//            $search_param['start_count'] = $message->start_count;
//            $search_param['end_count'] = $message->end_count;
//            $search_param['start_money'] = $message->start_price;
//            $search_param['end_money'] = $message->end_price;
//            $search_param['start_last_money_day'] = $message->start_money;
//            $search_param['end_last_money_day'] = $message->end_money;
//            $search_param['start_point'] = $message->start_point;
//            $search_param['end_point'] = $message->end_point;
//            $search_param['start_last_login_day'] = $message->start_login;
//            $search_param['end_last_login_day'] = $message->end_login;
//
//            $members_origin = User::where('role', 'user')->where('unique_id', 'like', '%'.$search_param['unique_id'].'%')->where('name', 'like', '%'.$search_param['name'].'%');
//            $members = $members_origin->get();
//            foreach ($members as $index => $member){
//                $birth = $member -> birth;
//                $birthYear = date('Y', strtotime($birth));
//                $cur_year = date("Y");
//                $age = $cur_year - $birthYear;
//
//                if(isset($search_param['gender'])){
//                    if($member->gender != $search_param['gender']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//                if(!empty($search_param['start_age'])){
//                    if($age < $search_param['start_age']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//                if(!empty($search_param['end_age'])){
//                    if($age > $search_param['end_age']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//
//                $buy_point = PointList::where('user_id', $member->id)->get();
//                $cnt = $buy_point->count();
//
//
//                if(!empty($search_param['start_count'])){
//                    if($cnt < $search_param['start_count']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//                if(!empty($search_param['end_count'])){
//                    if($cnt > $search_param['end_count']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//
//                $amount = 0;
//                foreach ($buy_point as $buy){
//                    $amount += $buy -> price;
//                }
//
//                if(!empty($search_param['start_money'])){
//                    if($amount < $search_param['start_money']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//                if(!empty($search_param['end_money'])){
//                    if($amount > $search_param['end_money']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//
//                if(!empty($search_param['start_last_money_day'])||!empty($search_param['end_last_money_day'])){
//                    $last_buy = PointList::where('user_id', $member->id)->orderBy('date', 'desc')->get()->first();
//
//                    if(!empty($search_param['start_last_money_day'])){
//                        if(!isset($last_buy)){
//                            unset($members[$index]);
//                            continue;
//                        }
//                        if(date('Y-m-d', strtotime($last_buy->date)) < date('Y-m-d', strtotime($search_param['start_last_money_day']))){
//                            unset($members[$index]);
//                            continue;
//                        }
//                    }
//                    if(!empty($search_param['end_last_money_day'])){
//                        if(!isset($last_buy)){
//                            unset($members[$index]);
//                            continue;
//                        }
//                        if(date('Y-m-d', strtotime($last_buy->date)) > date('Y-m-d', strtotime($search_param['end_last_money_day']))){
//                            unset($members[$index]);
//                            continue;
//                        }
//                    }
//                }
//
//                if(!empty($search_param['start_point'])){
//                    if($member->point < $search_param['start_point']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//                if(!empty($search_param['end_point'])){
//                    if($member->point > $search_param['end_point']){
//                        unset($members[$index]);
//                        continue;
//                    }
//                }
//
//                if(!empty($search_param['start_last_login_day']) || !empty($search_param['end_last_login_day'])){
//                    $last_login = LoginLog::where('user_id', $member->id)->orderBy('created_at', 'desc')->get()->first();
//
//                    if(!empty($search_param['start_last_login_day'])){
//                        if(!isset($last_login)){
//                            unset($members[$index]);
//                            continue;
//                        }
//                        if(date('Y-m-d', strtotime($last_login->created_at)) < date('Y-m-d', strtotime($search_param['start_last_login_day']))){
//                            unset($members[$index]);
//                            continue;
//                        }
//                    }
//                    if(!empty($search_param['end_last_login_day'])){
//                        if(!isset($last_login)){
//                            unset($members[$index]);
//                            continue;
//                        }
//                        if(date('Y-m-d',strtotime($last_login->created_at)) > date('Y-m-d', strtotime($search_param['end_last_login_day']))){
//                            unset($members[$index]);
//                            continue;
//                        }
//                    }
//                }
//            }
//            foreach ($members as $member){
//                $character = Character::where('id', $message->character_id)->get()->first();
//                $user = User::where('id', $member->id)->get()->first();
//                Log::warning('Cron sendReceivedMail by immediately: character_name:' . $character->name . ' email:' . $user->email);
//                sendReceivedMail($character->name, $user->email);
//            }
//        }
        return 0;
    }
}
