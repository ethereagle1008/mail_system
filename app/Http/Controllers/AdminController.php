<?php

namespace App\Http\Controllers;

use App\AutoMessage;
use App\Character;
use App\Http\Controllers\Controller;
use App\LoginLog;
use App\Mail;
use App\PointList;
use App\Question;
use App\Region;
use App\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function Psy\debug;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function searchMembers()
    {
//        $members_origin = User::where('role', 'user');
//        $members = $members_origin;
//        foreach ($members as $member) {
//            $birth = $member->birth;
//            $birthYear = date('Y', strtotime($birth));
//            $cur_year = date("Y");
//            if ($member->gender == 0) {
//                $member->gender = '男性';
//            } else {
//                $member->gender = '女性';
//            }
//
//            $member->age = $cur_year - $birthYear;
//            $login = LoginLog::where('user_id', $member->id)->orderBy('id', 'desc')->get()->first();
//            if (isset($login))
//                $member->last_login = $login->created_at;
//            else
//                $member->last_login = '';
//        }
//        $result = $members_origin->get()->count();
//        $pagination_params = [
//            'result' => $result,
//            'per_page' => 20,
//        ];
//        $search_param = [];
//        $search_param['unique_id'] = '';
//        $search_param['name'] = '';
//        $search_param['gender'] = '';
//        $search_param['start_age'] = '';
//        $search_param['end_age'] = '';
//        $search_param['start_count'] = '';
//        $search_param['end_count'] = '';
//        $search_param['start_money'] = '';
//        $search_param['end_money'] = '';
//        $search_param['start_last_money_day'] = '';
//        $search_param['end_last_money_day'] = '';
//        $search_param['start_point'] = '';
//        $search_param['end_point'] = '';
//        $search_param['start_last_login_day'] = '';
//        $search_param['end_last_login_day'] = '';

        return view('admin.search-members', [
            'tab' => 'search-members',
        ]);
    }

    public function searchMembersPost(Request $request)
    {
        $search_param = [];
        $search_param['unique_id'] = $request->input('unique_id');
        $search_param['name'] = $request->input('name');
        $search_param['gender'] = $request->input('gender');
        $search_param['start_age'] = $request->input('start_age');
        $search_param['end_age'] = $request->input('end_age');
        $search_param['start_count'] = $request->input('start_count');
        $search_param['end_count'] = $request->input('end_count');
        $search_param['start_money'] = $request->input('start_money');
        $search_param['end_money'] = $request->input('end_money');
        $search_param['start_last_money_day'] = $request->input('start_last_money_day');
        $search_param['end_last_money_day'] = $request->input('end_last_money_day');
        $search_param['start_point'] = $request->input('start_point');
        $search_param['end_point'] = $request->input('end_point');
        $search_param['start_last_login_day'] = $request->input('start_last_login_day');
        $search_param['end_last_login_day'] = $request->input('end_last_login_day');

        $members_origin = User::where('role', 'user')->where('unique_id', 'like', '%' . $search_param['unique_id'] . '%')->where('name', 'like', '%' . $search_param['name'] . '%');
        $members = $members_origin->get();
        foreach ($members as $index => $member) {
            $birth = $member->birth;
            $birthYear = date('Y', strtotime($birth));
            $cur_year = date("Y");
            $age = $cur_year - $birthYear;

            if (isset($search_param['gender'])) {
                if ($member->gender != $search_param['gender']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['start_age'])) {
                if ($age < $search_param['start_age']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_age'])) {
                if ($age > $search_param['end_age']) {
                    unset($members[$index]);
                    continue;
                }
            }

            $buy_point = PointList::where('user_id', $member->id)->get();
            $cnt = $buy_point->count();


            if (!empty($search_param['start_count'])) {
                if ($cnt < $search_param['start_count']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_count'])) {
                if ($cnt > $search_param['end_count']) {
                    unset($members[$index]);
                    continue;
                }
            }

            $amount = 0;
            foreach ($buy_point as $buy) {
                $amount += $buy->price;
            }

            if (!empty($search_param['start_money'])) {
                if ($amount < $search_param['start_money']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_money'])) {
                if ($amount > $search_param['end_money']) {
                    unset($members[$index]);
                    continue;
                }
            }

            if (!empty($search_param['start_last_money_day']) || !empty($search_param['end_last_money_day'])) {
                $last_buy = PointList::where('user_id', $member->id)->orderBy('date', 'desc')->get()->first();

                if (!empty($search_param['start_last_money_day'])) {
                    if (!isset($last_buy)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_buy->date)) < date('Y-m-d', strtotime($search_param['start_last_money_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_last_money_day'])) {
                    if (!isset($last_buy)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_buy->date)) > date('Y-m-d', strtotime($search_param['end_last_money_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
            }

            if (!empty($search_param['start_point'])) {
                if ($member->point < $search_param['start_point']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_point'])) {
                if ($member->point > $search_param['end_point']) {
                    unset($members[$index]);
                    continue;
                }
            }

            if (!empty($search_param['start_last_login_day']) || !empty($search_param['end_last_login_day'])) {
                $last_login = LoginLog::where('user_id', $member->id)->orderBy('created_at', 'desc')->get()->first();

                if (!empty($search_param['start_last_login_day'])) {
                    if (!isset($last_login)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_login->created_at)) < date('Y-m-d', strtotime($search_param['start_last_login_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_last_login_day'])) {
                    if (!isset($last_login)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_login->created_at)) > date('Y-m-d', strtotime($search_param['end_last_login_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
            }

            $member->age = $age;
            if ($member->gender == 0) {
                $member->gender = '男性';
            } else {
                $member->gender = '女性';
            }

            $login = LoginLog::where('user_id', $member->id)->orderBy('id', 'desc')->get()->first();
            if (isset($login))
                $member->last_login = $login->created_at;
            else
                $member->last_login = '';
        }
        //$result = $members_origin->get()->count();
//        $pagination_params = [
//            'result' => $result,
//            'per_page' => 20,
//        ];

        return view('admin.user-list', [
            'tab' => 'search-members',
            'members' => $members,
        ]);
    }

    public function memberDetail($member_id)
    {
        $member = User::where('id', $member_id)->get()->first();
        $login = LoginLog::where('user_id', $member_id)->orderBy('id', 'desc')->get()->first();
        $regions = Region::all();
        if (isset($login)) {
            $member->last_login = $login->created_at;
        } else {
            $member->last_login = '';
        }
        $pay_cnt = PointList::where('user_id', $member_id)->get()->count();
        $member->pay_cnt = $pay_cnt;
        if ($pay_cnt != 0) {
            $member_pay = PointList::where('user_id', $member_id)->select(DB::raw('sum(price) as price, sum(point) as point, user_id'))->groupBy('user_id')->get()->toArray();
//            print_r($member_pay);
//            die();
            $member->pay = $member_pay[0]['price'];

        } else {
            $member->pay = 0;
        }

        $birth = $member->birth;
        $birthYear = date('Y', strtotime($birth));
        $cur_year = date("Y");
        $member->age = $cur_year - $birthYear;
        $questions = Question::leftjoin('characters', 'characters.id', 'questions.character_id')->where('user_id', $member_id)->orderBy('receive_date', 'desc')->paginate(10);
        foreach ($questions as $question) {
            $birth = $question->birth;
            $birthYear = date('Y', strtotime($birth));
            $cur_year = date("Y");
            $question->age = $cur_year - $birthYear;
        }
        $result = Question::where('user_id', $member_id)->orderBy('receive_date', 'desc')->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 10,
        ];
        return view('admin.member-detail', compact('pagination_params'), [
            'tab' => 'search-members',
            'member' => $member,
            'questions' => $questions,
            'regions' => $regions
        ]);
    }

    public function memberPoint(Request $request)
    {
        date_default_timezone_set('Asia/Tokyo');
        $member_id = $request->member_id;
        $point = User::where('id', $member_id)->get()->first()->point;
        $point = $point + $request->point;
        User::where('id', $member_id)->update(['point' => $point]);
        return $this->memberDetail($member_id);
    }

    public function characterRegister()
    {
        return view('admin.character-register', [
            'tab' => 'character-register'
        ]);
    }

    public function autoMessage()
    {
        $characters = Character::orderBy('name', 'asc')->select(DB::raw('id, unique_id, name, gender, birth, image, decreasing_point, description'))->get()->toArray();
        $auto_message = AutoMessage::leftjoin('characters', 'characters.id', 'auto_messages.character_id')->select(DB::raw('auto_messages.*, characters.name'))->where('type', '0')->orderBy('send_time', 'desc')->paginate(10);
        $result = AutoMessage::leftjoin('characters', 'characters.id', 'auto_messages.character_id')->where('type', '0')->orderBy('send_time', 'desc')->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 10,
        ];
        $users = User::where('role', 'user')->orderBy('id')->get();
        return view('admin.auto-message', compact('pagination_params'), [
            'tab' => 'auto-message',
            'characters' => $characters,
            'messages' => $auto_message,
            'users' => $users
        ]);
    }

    public function autoModify(Request $request)
    {
        $question_id = $request->question_id;
        $content = $request->q_content;
        AutoMessage::where('id', $question_id)->update(['content' => $content]);
        return response()->json([
            'status' => true
        ]);
    }

    public function autoMessagePost(Request $request)
    {
        date_default_timezone_set('Asia/Tokyo');
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->photo->store('question', 'public');
        }
        if ($request->type == 0) {
            $send_time = date('Y-m-d H:i:s');
            $status = 1;
        } else {
            $send_time = date('Y-m-d H:i:s', strtotime($request->send_time));
            $status = 1;
        }

        if(isset($request->unique_id)){
            $unique_id = implode(",", $request->unique_id);
        }
        else{
            $unique_id = "";
        }

        $data = [
            'type' => $request->type,
            'send_time' => $send_time,
            'content' => $request->question_content,
            'image' => $photo ? asset('storage') . "/" . $photo : null,
            'character_id' => $request->character_id,
            'unique_id' => $unique_id,
            'gender' => $request->gender,
            'user_name' => $request->user_name,
            'start_age' => $request->start_age,
            'end_age' => $request->end_age,
            'start_count' => $request->start_count,
            'end_count' => $request->end_count,
            'start_point' => $request->start_point,
            'end_point' => $request->end_point,
            'start_price' => $request->start_price,
            'end_price' => $request->end_price,
            'start_login' => $request->start_login,
            'end_login' => $request->end_login,
            'start_money' => $request->start_money,
            'end_money' => $request->end_money,
            'status' => $status
        ];
        Log::info('AutoMessage Create: ' . date('Y-m-d H:i:s') .'/n send time: '. $send_time);
        AutoMessage::create($data);
        if ($request->type == 0) {
            $search_param = [];
            $search_param['unique_id'] = $request->input('unique_id');
            $search_param['name'] = $request->input('user_name');
            $search_param['gender'] = $request->input('gender');
            $search_param['start_age'] = $request->input('start_age');
            $search_param['end_age'] = $request->input('end_age');
            $search_param['start_count'] = $request->input('start_count');
            $search_param['end_count'] = $request->input('end_count');
            $search_param['start_money'] = $request->input('start_price');
            $search_param['end_money'] = $request->input('end_price');
            $search_param['start_last_money_day'] = $request->input('start_money');
            $search_param['end_last_money_day'] = $request->input('end_money');
            $search_param['start_point'] = $request->input('start_point');
            $search_param['end_point'] = $request->input('end_point');
            $search_param['start_last_login_day'] = $request->input('start_login');
            $search_param['end_last_login_day'] = $request->input('end_login');

            $members_origin = User::where('role', 'user')->where('name', 'like', '%' . $search_param['name'] . '%');
            $members = $members_origin->get();
            foreach ($members as $index => $member) {
                $birth = $member->birth;
                $birthYear = date('Y', strtotime($birth));
                $cur_year = date("Y");
                $age = $cur_year - $birthYear;

                if(isset($search_param['unique_id'])){
                    if(!in_array($member->unique_id, $search_param['unique_id'])){
                        unset($members[$index]);
                        continue;
                    }
                }

                if (isset($search_param['gender'])) {
                    if ($member->gender != $search_param['gender']) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['start_age'])) {
                    if ($age < $search_param['start_age']) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_age'])) {
                    if ($age > $search_param['end_age']) {
                        unset($members[$index]);
                        continue;
                    }
                }

                $buy_point = PointList::where('user_id', $member->id)->get();
                $cnt = $buy_point->count();

                if (!empty($search_param['start_count'])) {
                    if ($cnt < $search_param['start_count']) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_count'])) {
                    if ($cnt > $search_param['end_count']) {
                        unset($members[$index]);
                        continue;
                    }
                }

                $amount = 0;
                foreach ($buy_point as $buy) {
                    $amount += $buy->price;
                }

                if (!empty($search_param['start_money'])) {
                    if ($amount < $search_param['start_money']) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_money'])) {
                    if ($amount > $search_param['end_money']) {
                        unset($members[$index]);
                        continue;
                    }
                }

                if (!empty($search_param['start_last_money_day']) || !empty($search_param['end_last_money_day'])) {
                    $last_buy = PointList::where('user_id', $member->id)->orderBy('date', 'desc')->get()->first();

                    if (!empty($search_param['start_last_money_day'])) {
                        if (!isset($last_buy)) {
                            unset($members[$index]);
                            continue;
                        }
                        if (date('Y-m-d', strtotime($last_buy->date)) < date('Y-m-d', strtotime($search_param['start_last_money_day']))) {
                            unset($members[$index]);
                            continue;
                        }
                    }
                    if (!empty($search_param['end_last_money_day'])) {
                        if (!isset($last_buy)) {
                            unset($members[$index]);
                            continue;
                        }
                        if (date('Y-m-d', strtotime($last_buy->date)) > date('Y-m-d', strtotime($search_param['end_last_money_day']))) {
                            unset($members[$index]);
                            continue;
                        }
                    }
                }

                if (!empty($search_param['start_point'])) {
                    if ($member->point < $search_param['start_point']) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_point'])) {
                    if ($member->point > $search_param['end_point']) {
                        unset($members[$index]);
                        continue;
                    }
                }

                if (!empty($search_param['start_last_login_day']) || !empty($search_param['end_last_login_day'])) {
                    $last_login = LoginLog::where('user_id', $member->id)->orderBy('created_at', 'desc')->get()->first();

                    if (!empty($search_param['start_last_login_day'])) {
                        if (!isset($last_login)) {
                            unset($members[$index]);
                            continue;
                        }
                        if (date('Y-m-d', strtotime($last_login->created_at)) < date('Y-m-d', strtotime($search_param['start_last_login_day']))) {
                            unset($members[$index]);
                            continue;
                        }
                    }
                    if (!empty($search_param['end_last_login_day'])) {
                        if (!isset($last_login)) {
                            unset($members[$index]);
                            continue;
                        }
                        if (date('Y-m-d', strtotime($last_login->created_at)) > date('Y-m-d', strtotime($search_param['end_last_login_day']))) {
                            unset($members[$index]);
                            continue;
                        }
                    }
                }

                $member->age = $age;
                if ($member->gender == 0) {
                    $member->gender = '男性';
                } else {
                    $member->gender = '女性';
                }

                $login = LoginLog::where('user_id', $member->id)->orderBy('id', 'desc')->get()->first();
                if (isset($login))
                    $member->last_login = $login->created_at;
                else
                    $member->last_login = '';
            }

            foreach ($members as $member) {
                $message_text = $request->question_content;
                $import = User::where('id', $member->id)->get()->first();

                $message_arr_tmp = explode('%', $message_text);
                $message_arr = $message_arr_tmp;
                foreach ($message_arr as $index => $str) {

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
                        $message_arr[$index] = date('m月d日', strtotime($import['birth']));
                    }
                    if ($str == 'userpref') {
                        $message_arr[$index] = $import['region'];
                    }
                    if ($str == 'usersex') {
                        if ($import['gender'] == 0) {
                            $message_arr[$index] = '男性';
                        } else {
                            $message_arr[$index] = '女性';
                        }
                        //$message_arr[$index] = $import['gender'];
                    }
                }

                $content = '';
                foreach ($message_arr as $str) {
                    $content = $content . $str;
                }
                $data = [
                    'character_id' => $request->character_id,
                    'user_id' => $member->id,
                    'content' => $content,
                    'type' => 'character_sent',
                    'receive_date' => date('Y-m-d H:i:s'),
                    'image_url' => $photo ? asset('storage') . "/" . $photo : null
                ];

                $sub_content = mb_substr($content, 0, 20);;
                $q_id = Question::create($data)->id;
                $mail_data = [
                    'question_id' => $q_id,
                    'user_id' => $member->id,
                    'content' => $sub_content,
                    'send_time' => date('Y-m-d H:i:s'),
                ];
                Mail::create($mail_data);
            }
        }
        return $this->autoMessage();
    }

    public function selectUsers(Request $request)
    {
        $search_param = [];
        $search_param['unique_id'] = $request->input('unique_id');
        $search_param['name'] = $request->input('user_name');
        $search_param['gender'] = $request->input('gender');
        $search_param['start_age'] = $request->input('start_age');
        $search_param['end_age'] = $request->input('end_age');
        $search_param['start_count'] = $request->input('start_count');
        $search_param['end_count'] = $request->input('end_count');
        $search_param['start_money'] = $request->input('start_price');
        $search_param['end_money'] = $request->input('end_price');
        $search_param['start_last_money_day'] = $request->input('start_money');
        $search_param['end_last_money_day'] = $request->input('end_money');
        $search_param['start_point'] = $request->input('start_point');
        $search_param['end_point'] = $request->input('end_point');
        $search_param['start_last_login_day'] = $request->input('start_login');
        $search_param['end_last_login_day'] = $request->input('end_login');

        $members_origin = User::where('role', 'user')->where('name', 'like', '%' . $search_param['name'] . '%');
        $members = $members_origin->paginate(20);
        foreach ($members as $index => $member) {
            $birth = $member->birth;
            $birthYear = date('Y', strtotime($birth));
            $cur_year = date("Y");
            $age = $cur_year - $birthYear;
            if(isset($search_param['unique_id'])){
                if(!in_array($member->unique_id, $search_param['unique_id'])){
                    unset($members[$index]);
                    continue;
                }
            }

            if (isset($search_param['gender'])) {
                if ($member->gender != $search_param['gender']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['start_age'])) {
                if ($age < $search_param['start_age']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_age'])) {
                if ($age > $search_param['end_age']) {
                    unset($members[$index]);
                    continue;
                }
            }

            $buy_point = PointList::where('user_id', $member->id)->get();
            $cnt = $buy_point->count();


            if (!empty($search_param['start_count'])) {
                if ($cnt < $search_param['start_count']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_count'])) {
                if ($cnt > $search_param['end_count']) {
                    unset($members[$index]);
                    continue;
                }
            }

            $amount = 0;
            foreach ($buy_point as $buy) {
                $amount += $buy->price;
            }

            if (!empty($search_param['start_money'])) {
                if ($amount < $search_param['start_money']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_money'])) {
                if ($amount > $search_param['end_money']) {
                    unset($members[$index]);
                    continue;
                }
            }

            if (!empty($search_param['start_last_money_day']) || !empty($search_param['end_last_money_day'])) {
                $last_buy = PointList::where('user_id', $member->id)->orderBy('date', 'desc')->get()->first();

                if (!empty($search_param['start_last_money_day'])) {
                    if (!isset($last_buy)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_buy->date)) < date('Y-m-d', strtotime($search_param['start_last_money_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_last_money_day'])) {
                    if (!isset($last_buy)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_buy->date)) > date('Y-m-d', strtotime($search_param['end_last_money_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
            }

            if (!empty($search_param['start_point'])) {
                if ($member->point < $search_param['start_point']) {
                    unset($members[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_point'])) {
                if ($member->point > $search_param['end_point']) {
                    unset($members[$index]);
                    continue;
                }
            }

            if (!empty($search_param['start_last_login_day']) || !empty($search_param['end_last_login_day'])) {
                $last_login = LoginLog::where('user_id', $member->id)->orderBy('created_at', 'desc')->get()->first();

                if (!empty($search_param['start_last_login_day'])) {
                    if (!isset($last_login)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_login->created_at)) < date('Y-m-d', strtotime($search_param['start_last_login_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_last_login_day'])) {
                    if (!isset($last_login)) {
                        unset($members[$index]);
                        continue;
                    }
                    if (date('Y-m-d', strtotime($last_login->created_at)) > date('Y-m-d', strtotime($search_param['end_last_login_day']))) {
                        unset($members[$index]);
                        continue;
                    }
                }
            }

            $member->age = $age;
            if ($member->gender == 0) {
                $member->gender = '男性';
            } else {
                $member->gender = '女性';
            }

            $login = LoginLog::where('user_id', $member->id)->orderBy('id', 'desc')->get()->first();
            if (isset($login))
                $member->last_login = $login->created_at;
            else
                $member->last_login = '';
        }
        $result = $members_origin->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 20,
        ];
        return view('admin.select-users', compact('pagination_params'), [
            'tab' => 'auto-message',
            'members' => $members,
            'search_param' => $search_param
        ]);
    }

    public function autoMessageList()
    {
        $auto_message = AutoMessage::leftjoin('characters', 'characters.id', 'auto_messages.character_id')->select(DB::raw('auto_messages.*, characters.name'))->where('type', '1')->orderBy('send_time', 'desc')->paginate(10);
        $result = AutoMessage::leftjoin('characters', 'characters.id', 'auto_messages.character_id')->where('type', '1')->orderBy('send_time', 'desc')->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 10,
        ];
        return view('admin.auto-list', compact('pagination_params'), [
            'tab' => 'auto-list',
            'messages' => $auto_message,
        ]);
    }

    public function autoDelete($auto_id)
    {
        AutoMessage::where('id', $auto_id)->delete();
        return $this->autoMessageList();
    }

    public function memberDelete(Request $request)
    {
        $member_id = $request->user_id;
        User::where('id', $member_id)->delete();
        Question::where('user_id', $member_id)->delete();
        LoginLog::where('user_id', $member_id)->delete();
        Mail::where('user_id', $member_id)->where('status', 'nosent')->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function memberMultiDelete(Request $request)
    {
        $members = $request->user_id;
        foreach ($members as $member_id){
            User::where('id', $member_id)->delete();
            Question::where('user_id', $member_id)->delete();
            LoginLog::where('user_id', $member_id)->delete();
            Mail::where('user_id', $member_id)->where('status', 'nosent')->delete();
        }
        return response()->json([
            'status' => true
        ]);
    }

    public function characterDelete(Request $request)
    {
        $member_id = $request->character_id;
        Character::where('id', $member_id)->delete();
        Question::where('character_id', $member_id)->delete();
        AutoMessage::where('character_id', $member_id)->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function characterRegisterPost(Request $request)
    {
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->photo->store('question', 'public');
        }

        $data = [
            'unique_id' => rand(1000000, 9999999),
            'name' => $request->name,
            'description' => $request->description,
            'gender' => $request->gender,
            'birth' => date('Y-m-d', strtotime($request->birthday)),
            'ranking' => 1,
            'decreasing_point' => $request->decreasing_point,
            'image' => $photo ? asset('storage') . "/" . $photo : null
        ];
        Character::create($data);
        return view('admin.character-register', [
            'tab' => 'character-register'
        ]);
    }

    public function modifyCharacter(Request $request)
    {
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->photo->store('question', 'public');
        }
        if ($photo == null) {
            $data = [
                'name' => $request->name,
                'description' => $request->message,
                'gender' => $request->gender,
                'birth' => date('Y-m-d', strtotime($request->birthday)),
                'decreasing_point' => $request->decreasing_point,
            ];
        } else {
            $data = [
                'name' => $request->name,
                'description' => $request->message,
                'gender' => $request->gender,
                'birth' => date('Y-m-d', strtotime($request->birthday)),
                'decreasing_point' => $request->decreasing_point,
                'image' => $photo ? asset('storage') . "/" . $photo : null
            ];
        }


        Character::where('id', $request->character_id)->update($data);
        return response()->json([
            'status' => true
        ]);
    }

    public function modifyUser(Request $request)
    {
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->photo->store('question', 'public');
        }
        if ($photo == null) {
            $data = [
                'name' => $request->name,
                'gender' => $request->gender,
                'region' => $request->region,
                'birth' => date('Y-m-d', strtotime($request->birthday)),
            ];
        } else {
            $data = [
                'name' => $request->name,
                'gender' => $request->gender,
                'region' => $request->region,
                'birth' => date('Y-m-d', strtotime($request->birthday)),
                'image' => $photo ? asset('storage') . "/" . $photo : null
            ];
        }


        User::where('id', $request->user_id)->update($data);
        return response()->json([
            'status' => true
        ]);
    }

    public function searchCharacters()
    {
        $characters_origin = Character::orderBy('id', 'asc');
        $characters = $characters_origin->paginate(20);
        foreach ($characters as $character) {
            $birth = $character->birth;
            $birthYear = date('Y', strtotime($birth));
            $cur_year = date("Y");
            if ($character->gender == 0) {
                $character->gender = '男性';
            } else {
                $character->gender = '女性';
            }

            $character->age = $cur_year - $birthYear;
//            $login = LoginLog::where('user_id', $characters->id)->orderBy('id', 'desc')->get()->first();
//            if(isset($login))
//                $member -> last_login = $login -> created_at;
//            else
//                $member->last_login = '';
        }
        $result = $characters_origin->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 20,
        ];
        $search_param = [];
        $search_param['unique_id'] = '';
        $search_param['name'] = '';
        $search_param['gender'] = '';
        $search_param['start_age'] = '';
        $search_param['end_age'] = '';
        $search_param['start_reply_count'] = '';
        $search_param['end_reply_count'] = '';
        $search_param['description'] = '';
        $search_param['start_no_reply'] = '';
        $search_param['end_no_reply'] = '';
        $search_param['start_last_login_day'] = '';
        $search_param['end_last_login_day'] = '';

        return view('admin.search-characters', compact('pagination_params'), [
            'tab' => 'search-characters',
            'characters' => $characters,
            'search_param' => $search_param
        ]);
    }

    public function searchCharactersPost(Request $request)
    {
        $search_param = [];
        $search_param['unique_id'] = $request->input('unique_id');
        $search_param['name'] = $request->input('name');
        $search_param['gender'] = $request->input('gender');
        $search_param['start_age'] = $request->input('start_age');
        $search_param['end_age'] = $request->input('end_age');
        $search_param['start_reply_count'] = $request->input('start_reply_count');
        $search_param['end_reply_count'] = $request->input('end_reply_count');
        $search_param['description'] = $request->input('description');
        $search_param['start_no_reply'] = $request->input('start_no_reply');
        $search_param['end_no_reply'] = $request->input('end_no_reply');
        $search_param['start_last_login_day'] = $request->input('start_last_login_day');
        $search_param['end_last_login_day'] = $request->input('end_last_login_day');

        $characters_origin = Character::where('unique_id', 'like', '%' . $search_param['unique_id'] . '%')->where('name', 'like', '%' . $search_param['name'] . '%')
            ->where('description', 'like', '%' . $search_param['description'] . '%');
        $characters = $characters_origin->paginate(30);
        foreach ($characters as $index => $character) {
            $birth = $character->birth;
            $birthYear = date('Y', strtotime($birth));
            $cur_year = date("Y");
            $age = $cur_year - $birthYear;

            if (isset($search_param['gender'])) {
                if ($character->gender != $search_param['gender']) {
                    unset($characters[$index]);
                    continue;
                }
            }
            if (!empty($search_param['start_age'])) {
                if ($age < $search_param['start_age']) {
                    unset($characters[$index]);
                    continue;
                }
            }
            if (!empty($search_param['end_age'])) {
                if ($age > $search_param['end_age']) {
                    unset($characters[$index]);
                    continue;
                }
            }
            if (!empty($search_param['start_reply_count']) || !empty($search_param['end_reply_count'])) {
                $cnt = Question::where('character_id', $character->id)->where('type', 'character_sent')->get()->count();
                if (!empty($search_param['start_reply_count'])) {
                    if ($cnt < $search_param['start_reply_count']) {
                        unset($characters[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_reply_count'])) {
                    if ($cnt > $search_param['end_reply_count']) {
                        unset($characters[$index]);
                        continue;
                    }
                }
            }
            if (!empty($search_param['start_no_reply']) || !empty($search_param['end_no_reply'])) {
                $cnt_reply = Question::where('character_id', $character->id)->where('type', 'character_sent')->get()->count();
                $cnt_receive = Question::where('character_id', $character->id)->where('type', 'user_sent')->get()->count();
                $cnt = $cnt_receive - $cnt_reply;
                if (!empty($search_param['start_no_reply'])) {
                    if ($cnt < $search_param['start_no_reply']) {
                        unset($characters[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_no_reply'])) {
                    if ($cnt > $search_param['end_no_reply']) {
                        unset($characters[$index]);
                        continue;
                    }
                }
            }

            if (!empty($search_param['start_last_login_day']) || !empty($search_param['end_last_login_day'])) {

                if (!empty($search_param['start_last_login_day'])) {

                    if (date('Y-m-d', strtotime($character->created_at)) < date('Y-m-d', strtotime($search_param['start_last_login_day']))) {
                        unset($characters[$index]);
                        continue;
                    }
                }
                if (!empty($search_param['end_last_login_day'])) {
                    if (date('Y-m-d', strtotime($character->created_at)) > date('Y-m-d', strtotime($search_param['end_last_login_day']))) {
                        unset($characters[$index]);
                        continue;
                    }
                }
            }

            $character->age = $age;
            if ($character->gender == 0) {
                $character->gender = '男性';
            } else {
                $character->gender = '女性';
            }
        }
        $result = $characters_origin->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 30,
        ];

        return view('admin.search-characters', compact('pagination_params'), [
            'tab' => 'search-characters',
            'characters' => $characters,
            'search_param' => $search_param
        ]);
    }

    public function questionModify(Request $request)
    {
        $question_id = $request->question_id;
        $content = $request->q_content;
        Question::where('id', $question_id)->update(['content' => $content]);
        return response()->json([
            'status' => true
        ]);

    }

    public function saveMemo(Request $request)
    {
        $user_id = $request->user_id;
        $memo = $request->memo;
        User::where('id', $user_id)->update(['memo' => $memo]);
        return response()->json([
            'status' => true
        ]);

    }

    public function characterDetail($character_id)
    {
        $character = Character::where('id', $character_id)->get()->first();
        $birth = $character->birth;
        $birthYear = date('Y', strtotime($birth));
        $cur_year = date("Y");
        $character->age = $cur_year - $birthYear;
        $questions = Question::leftjoin('users', 'users.id', 'questions.user_id')->select(DB::raw('questions.*, users.*, questions.id as question_id'))->where('character_id', $character_id)->orderBy('receive_date', 'desc')->paginate(10);
        $messages = Question::leftjoin('users', 'users.id', 'questions.user_id')->select(DB::raw('questions.*, users.*, questions.id as question_id'))->where('character_id', $character_id)->where('reply', '0')->where('type', 'user_sent')->orderBy('receive_date', 'desc')->paginate(10);
        foreach ($questions as $question) {
            $last_login = LoginLog::where('user_id', $question->user_id)->orderBy('id', 'desc')->get()->first();
            if (isset($last_login))
                $question->last_login = $last_login->created_at;
            else
                $question->last_login = '';
            $pay_cnt = PointList::where('user_id', $question->user_id)->get()->count();
            $question->pay_cnt = $pay_cnt;
            if ($pay_cnt != 0) {
                $member_pay = PointList::where('user_id', $question->user_id)->select(DB::raw('sum(price) as price, sum(point) as point, user_id'))->groupBy('user_id')->get()->toArray();
//            print_r($member_pay);
//            die();
                $question->pay = $member_pay[0]['price'];

            } else {
                $question->pay = 0;
            }

        }
        foreach ($messages as $question) {
            $last_login = LoginLog::where('user_id', $question->user_id)->orderBy('id', 'desc')->get()->first();
            if (isset($last_login))
                $question->last_login = $last_login->created_at;
            else
                $question->last_login = '';
            $pay_cnt = PointList::where('user_id', $question->user_id)->get()->count();
            $question->pay_cnt = $pay_cnt;
            if ($pay_cnt != 0) {
                $member_pay = PointList::where('user_id', $question->user_id)->select(DB::raw('sum(price) as price, sum(point) as point, user_id'))->groupBy('user_id')->get()->toArray();
//            print_r($member_pay);
//            die();
                $question->pay = $member_pay[0]['price'];

            } else {
                $question->pay = 0;
            }
        }
        $user_questions = Question::where('character_id', $character_id)->where('type', 'user_sent')->where('status', 'unread')->get();
        foreach ($user_questions as $user_question) {
            Question::where('id', $user_question->id)->update(['status' => 'read']);
        }
        $users = User::where('role', 'user')->get();
        $result = Question::where('character_id', $character_id)->orderBy('receive_date', 'desc')->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 10,
        ];
        return view('admin.character-detail', compact('pagination_params'), [
            'tab' => 'search-characters',
            'character' => $character,
            'questions' => $questions,
            'users' => $users,
            'messages' => $messages
        ]);
    }

    public function characterPoint(Request $request)
    {
        $character_id = $request->character_id;
        $decreasing_point = $request->decreasing_point;
        Character::where('id', $character_id)->update(['decreasing_point' => $decreasing_point]);
        return $this->characterDetail($character_id);
    }

    public function userSend(Request $request)
    {
        $photo = null;
        date_default_timezone_set('Asia/Tokyo');
        if ($request->hasFile('photo')) {
            $photo = $request->photo->store('question', 'public');
        }
        $type = $request->type;
        $message_text = $request->question_content;
        $import = User::where('id', $request->user_id)->get()->first();

        $message_arr_tmp = explode('%', $message_text);
        $message_arr = $message_arr_tmp;
        foreach ($message_arr as $index => $str) {

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
                $message_arr[$index] = date('m月d日', strtotime($import['birth']));
            }
            if ($str == 'userpref') {
                $message_arr[$index] = $import['region'];
            }
            if ($str == 'usersex') {
                if ($import['gender'] == 0) {
                    $message_arr[$index] = '男性';
                } else {
                    $message_arr[$index] = '女性';
                }
                //$message_arr[$index] = $import['gender'];
            }
        }

        $content = '';
        foreach ($message_arr as $str) {
            $content = $content . $str;
        }
        if ($type == '0') {
            $data = [
                'user_id' => $request->user_id,
                'character_id' => $request->character_id,
                'content' => $content,
                'type' => 'character_sent',
                'receive_date' => date('Y-m-d H:i:s'),
                'image_url' => $photo ? asset('storage') . "/" . $photo : null
            ];
            $q_id = Question::create($data)->id;
            $mail_data = [
                'question_id' => $q_id,
                'user_id' => $request->user_id,
                'content' => mb_substr($content, 0, 20),
                'send_time' => date('Y-m-d H:i:s'),
            ];
            Mail::create($mail_data);
        } else {
            $send_time = $request->send_time;
            $data = [
                'user_id' => $request->user_id,
                'character_id' => $request->character_id,
                'content' => $content,
                'type' => 'character_sent',
                'receive_date' => $send_time,
                'image_url' => $photo ? asset('storage') . "/" . $photo : null
            ];
            $q_id = Question::create($data)->id;
            $mail_data = [
                'question_id' => $q_id,
                'user_id' => $request->user_id,
                'content' => mb_substr($content, 0, 20),
                'send_time' => $send_time,
            ];
            Mail::create($mail_data);
        }

        Question::where('id', $request->question_id)->update(['reply' => '1']);
        return response()->json([
            'status' => true
        ]);
    }

    public function totalSales()
    {
        $point_lists = PointList::select(DB::raw('sum(price) as price, sum(point) as point, hour'))->groupBy('hour')->orderBy('created_at', 'desc')->paginate(20);
        $result = PointList::select(DB::raw('sum(price) as price, sum(point) as point, hour'))->groupBy('hour')->orderBy('created_at', 'desc')->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 20,
        ];
        foreach ($point_lists as $list) {
            $hour = $list->hour;
            $hour_arr = explode(' ', $hour);
            $day_arr = explode('-', $hour_arr[0]);
            $time_arr = explode(':', $hour_arr[1]);
            $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月' . $day_arr[2] . '日' . ' ' . $time_arr[0] . '時';
            $list->hour_str = $hour_str;
        }
        $search_param = [];
        $search_param['start_day'] = '';
        $search_param['start_hour'] = '';
        $search_param['start_min'] = '';
        $search_param['end_day'] = '';
        $search_param['end_hour'] = 0;
        $search_param['end_min'] = 0;
        $search_param['start_register'] = '';
        $search_param['start_register_hour'] = 0;
        $search_param['start_register_min'] = 0;
        $search_param['end_register'] = '';
        $search_param['end_register_hour'] = 0;
        $search_param['end_register_min'] = 0;
        $search_param['unit'] = 'hour';

        return view('admin.total-sales', compact('pagination_params'), [
            'tab' => 'total-sales',
            'point_lists' => $point_lists,
            'search_param' => $search_param
        ]);
    }

    public function adTotal()
    {
        $point_lists = PointList::select(DB::raw('sum(price) as price, sum(point) as point, hour'))->groupBy('hour')->orderBy('created_at', 'desc')->paginate(20);
        $result = PointList::select(DB::raw('sum(price) as price, sum(point) as point, hour'))->groupBy('hour')->orderBy('created_at', 'desc')->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 20,
        ];
        foreach ($point_lists as $list) {
            $hour = $list->hour;

            $hour_arr = explode(' ', $hour);
            $day_arr = explode('-', $hour_arr[0]);
            $time_arr = explode(':', $hour_arr[1]);
            $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月' . $day_arr[2] . '日' . ' ' . $time_arr[0] . '時';
            $list->hour_str = $hour_str;
        }
        $search_param = [];
        $search_param['start_day'] = '';
        $search_param['start_hour'] = '';
        $search_param['start_min'] = '';
        $search_param['end_day'] = '';
        $search_param['end_hour'] = 0;
        $search_param['end_min'] = 0;
        $search_param['start_register'] = '';
        $search_param['start_register_hour'] = 0;
        $search_param['start_register_min'] = 0;
        $search_param['end_register'] = '';
        $search_param['end_register_hour'] = 0;
        $search_param['end_register_min'] = 0;
        $search_param['unit'] = 'hour';

        return view('admin.ad-total', compact('pagination_params'), [
            'tab' => 'ad-total',
            'point_lists' => $point_lists,
            'search_param' => $search_param
        ]);
    }

    public function getTotalSales(Request $request)
    {
        $search_param = [];
        $search_param['start_day'] = $request->start_day;;
        $search_param['start_hour'] = $request->start_hour;;
        $search_param['start_min'] = $request->start_min;;
        $search_param['end_day'] = $request->end_day;;
        $search_param['end_hour'] = $request->end_hour;;
        $search_param['end_min'] = $request->end_min;;
        $search_param['start_register'] = $request->start_register;;
        $search_param['start_register_hour'] = $request->start_register_hour;;
        $search_param['start_register_min'] = $request->start_register_min;;
        $search_param['end_register'] = $request->end_register;;
        $search_param['end_register_hour'] = $request->end_register_hour;;
        $search_param['end_register_min'] = $request->end_register_min;;
        $search_param['unit'] = $request->unit;


        $point_lists = PointList::orderBy('created_at', 'asc')->get()->toArray();

        if (!isset($search_param['start_day'])) {
            $start_day = $point_lists[0]['created_at'];
        } else {
            $start_day = date('Y-m-d H:i:s', strtotime($request->start_day_time));
        }

        if (!isset($search_param['end_day'])) {
            $end_day = $point_lists[count($point_lists) - 1]['created_at'];
        } else {
            $end_day = date('Y-m-d H:i:s', strtotime($request->end_day_time));
        }

        if ($search_param['unit'] == 'hour') {
            if (!isset($search_param['start_register']) && !isset($search_param['end_register'])) {
                $point_lists = PointList::where('created_at', '>=', $start_day)->where('created_at', '<=', $end_day)->select(DB::raw('sum(price) as price, sum(point) as point, hour'))
                    ->groupBy('hour')->orderBy('created_at', 'desc')->paginate(20);
                $result = PointList::where('created_at', '>=', $start_day)->where('created_at', '<=', $end_day)->select(DB::raw('sum(price) as price, sum(point) as point, hour'))
                    ->groupBy('hour')->orderBy('created_at', 'desc')->get()->count();
            } else if (isset($search_param['start_register']) && isset($search_param['end_register'])) {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, hour'))
                    ->groupBy('hour')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, hour'))
                    ->groupBy('hour')->orderBy('point_lists.created_at', 'desc')->get()->count();
            } else if (isset($search_param['start_register'])) {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, hour'))
                    ->groupBy('hour')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, hour'))
                    ->groupBy('hour')->orderBy('point_lists.created_at', 'desc')->get()->count();
            } else {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, hour'))
                    ->groupBy('hour')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, hour'))
                    ->groupBy('hour')->orderBy('point_lists.created_at', 'desc')->get()->count();
            }

            $pagination_params = [
                'result' => $result,
                'per_page' => 20,
            ];
            foreach ($point_lists as $list) {
                $hour = $list->hour;

                $hour_arr = explode(' ', $hour);
                $day_arr = explode('-', $hour_arr[0]);
                $time_arr = explode(':', $hour_arr[1]);
                $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月' . $day_arr[2] . '日' . ' ' . $time_arr[0] . '時';
                $list->hour_str = $hour_str;
            }
        }
        if ($search_param['unit'] == 'day') {
            if (!isset($search_param['start_register']) && !isset($search_param['end_register'])) {
                $point_lists = PointList::where('created_at', '>=', $start_day)->where('created_at', '<=', $end_day)->select(DB::raw('sum(price) as price, sum(point) as point, day'))
                    ->groupBy('day')->orderBy('created_at', 'desc')->paginate(20);
                $result = PointList::where('created_at', '>=', $start_day)->where('created_at', '<=', $end_day)->select(DB::raw('sum(price) as price, sum(point) as point, day'))
                    ->groupBy('day')->orderBy('created_at', 'desc')->get()->count();
            } else if (isset($search_param['start_register']) && isset($search_param['end_register'])) {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, day'))
                    ->groupBy('day')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, day'))
                    ->groupBy('day')->orderBy('point_lists.created_at', 'desc')->get()->count();
            } else if (isset($search_param['start_register'])) {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, day'))
                    ->groupBy('day')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, day'))
                    ->groupBy('day')->orderBy('point_lists.created_at', 'desc')->get()->count();
            } else {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, day'))
                    ->groupBy('day')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, day'))
                    ->groupBy('day')->orderBy('point_lists.created_at', 'desc')->get()->count();
            }

            $pagination_params = [
                'result' => $result,
                'per_page' => 20,
            ];
            foreach ($point_lists as $list) {
                $hour = $list->day;
                $day_arr = explode('-', $hour);
                $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月' . $day_arr[2] . '日';
                $list->hour_str = $hour_str;
            }
        }
        if ($search_param['unit'] == 'month') {
            if (!isset($search_param['start_register']) && !isset($search_param['end_register'])) {
                $point_lists = PointList::where('created_at', '>=', $start_day)->where('created_at', '<=', $end_day)->select(DB::raw('sum(price) as price, sum(point) as point, month'))
                    ->groupBy('month')->orderBy('created_at', 'desc')->paginate(20);
                $result = PointList::where('created_at', '>=', $start_day)->where('created_at', '<=', $end_day)->select(DB::raw('sum(price) as price, sum(point) as point, month'))
                    ->groupBy('month')->orderBy('created_at', 'desc')->get()->count();
            } else if (isset($search_param['start_register']) && isset($search_param['end_register'])) {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, month'))
                    ->groupBy('month')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, month'))
                    ->groupBy('month')->orderBy('point_lists.created_at', 'desc')->get()->count();
            } else if (isset($search_param['start_register'])) {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, month'))
                    ->groupBy('month')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                    ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, month'))
                    ->groupBy('month')->orderBy('point_lists.created_at', 'desc')->get()->count();
            } else {
                $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, month'))
                    ->groupBy('month')->orderBy('point_lists.created_at', 'desc')->paginate(20);
                $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                    ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                    ->select(DB::raw('sum(price) as price, sum(point_lists.point) as point, month'))
                    ->groupBy('month')->orderBy('point_lists.created_at', 'desc')->get()->count();
            }

            $pagination_params = [
                'result' => $result,
                'per_page' => 20,
            ];
            foreach ($point_lists as $list) {
                $hour = $list->month;
                $day_arr = explode('-', $hour);
                $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月';
                $list->hour_str = $hour_str;
            }
        }
        return view('admin.total-sales', compact('pagination_params'), [
            'tab' => 'total-sales',
            'point_lists' => $point_lists,
            'search_param' => $search_param
        ]);
    }

    public function payList()
    {
        $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->orderBy('point_lists.created_at', 'desc')->paginate(20);
        $result = PointList::orderBy('created_at', 'desc')->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 20,
        ];
        foreach ($point_lists as $list) {
            $hour = $list->hour;
            if ($list->gender == 0) {
                $list->gender = '男性';
            } else {
                $list->gender = '女性';
            }

            $total_price = PointList::where('user_id', $list->user_id)->select(DB::raw('sum(point_lists.price) as price, user_id'))->groupBy('user_id')->get()->toArray();
            $total_price = $total_price[0]['price'];
            $total_cnt = PointList::where('user_id', $list->user_id)->get()->count();
            $list->total_price = $total_price;
            $list->total_cnt = $total_cnt;
            $hour_arr = explode(' ', $hour);
            $day_arr = explode('-', $hour_arr[0]);
            $time_arr = explode(':', $hour_arr[1]);
            $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月' . $day_arr[2] . '日' . ' ' . $time_arr[0] . '時';
            $list->hour_str = $hour_str;
        }
        $search_param = [];
        $search_param['start_day'] = '';
        $search_param['start_hour'] = '';
        $search_param['start_min'] = '';
        $search_param['end_day'] = '';
        $search_param['end_hour'] = 0;
        $search_param['end_min'] = 0;
        $search_param['start_register'] = '';
        $search_param['start_register_hour'] = 0;
        $search_param['start_register_min'] = 0;
        $search_param['end_register'] = '';
        $search_param['end_register_hour'] = 0;
        $search_param['end_register_min'] = 0;
        $search_param['unit'] = 'hour';

        return view('admin.pay-list', compact('pagination_params'), [
            'tab' => 'pay-list',
            'point_lists' => $point_lists,
            'search_param' => $search_param
        ]);
    }

    public function getPayList(Request $request)
    {
        $search_param = [];
        $search_param['start_day'] = $request->start_day;;
        $search_param['start_hour'] = $request->start_hour;;
        $search_param['start_min'] = $request->start_min;;
        $search_param['end_day'] = $request->end_day;;
        $search_param['end_hour'] = $request->end_hour;;
        $search_param['end_min'] = $request->end_min;;
        $search_param['start_register'] = $request->start_register;;
        $search_param['start_register_hour'] = $request->start_register_hour;;
        $search_param['start_register_min'] = $request->start_register_min;;
        $search_param['end_register'] = $request->end_register;;
        $search_param['end_register_hour'] = $request->end_register_hour;;
        $search_param['end_register_min'] = $request->end_register_min;;

        $point_lists = PointList::orderBy('created_at', 'asc')->get()->toArray();

        if (!isset($search_param['start_day'])) {
            $start_day = $point_lists[0]['created_at'];
        } else {
            $start_day = date('Y-m-d H:i:s', strtotime($request->start_day_time));
        }

        if (!isset($search_param['end_day'])) {
            $end_day = $point_lists[count($point_lists) - 1]['created_at'];
        } else {
            $end_day = date('Y-m-d H:i:s', strtotime($request->end_day_time));
        }

        if (!isset($search_param['start_register']) && !isset($search_param['end_register'])) {
            $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->paginate(20);
            $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->get()->count();
        } else if (isset($search_param['start_register']) && isset($search_param['end_register'])) {
            $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->paginate(20);
            $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))
                ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->get()->count();
        } else if (isset($search_param['start_register'])) {
            $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->paginate(20);
            $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')->where('email_verified_at', '>=', date('Y-m-d H:i:s', strtotime($request->start_register_time)))
                ->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->get()->count();
        } else {
            $point_lists = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->paginate(20);
            $result = PointList::leftjoin('users', 'users.id', 'point_lists.user_id')
                ->where('email_verified_at', '<=', date('Y-m-d H:i:s', strtotime($request->end_register_time)))->where('point_lists.created_at', '>=', $start_day)->where('point_lists.created_at', '<=', $end_day)
                ->orderBy('point_lists.created_at', 'desc')->get()->count();
        }
        foreach ($point_lists as $list) {
            $hour = $list->hour;
            if ($list->gender == 0) {
                $list->gender = '男性';
            } else {
                $list->gender = '女性';
            }

            $total_price = PointList::where('user_id', $list->user_id)->select(DB::raw('sum(point_lists.price) as price, user_id'))->groupBy('user_id')->get()->toArray();
            $total_price = $total_price[0]['price'];
            $total_cnt = PointList::where('user_id', $list->user_id)->get()->count();
            $list->total_price = $total_price;
            $list->total_cnt = $total_cnt;
            $hour_arr = explode(' ', $hour);
            $day_arr = explode('-', $hour_arr[0]);
            $time_arr = explode(':', $hour_arr[1]);
            $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月' . $day_arr[2] . '日' . ' ' . $time_arr[0] . '時';
            $list->hour_str = $hour_str;
        }
        $pagination_params = [
            'result' => $result,
            'per_page' => 20,
        ];
        foreach ($point_lists as $list) {
            $hour = $list->hour;
            $hour_arr = explode(' ', $hour);
            $day_arr = explode('-', $hour_arr[0]);
            $time_arr = explode(':', $hour_arr[1]);
            $hour_str = $day_arr[0] . '年' . $day_arr[1] . '月' . $day_arr[2] . '日' . ' ' . $time_arr[0] . '時';
            $list->hour_str = $hour_str;
        }
        return view('admin.pay-list', compact('pagination_params'), [
            'tab' => 'pay-list',
            'point_lists' => $point_lists,
            'search_param' => $search_param
        ]);

    }

    public function csvImport()
    {
        $characters = Character::orderBy('name', 'asc')->select(DB::raw('id, unique_id, name, gender, birth, image, decreasing_point, description'))->get()->toArray();
        return view('admin.csv-import', [
            'tab' => 'csv-import',
            'characters' => $characters
        ]);
    }

    public function sendCsvImport(Request $request)
    {
        date_default_timezone_set('Asia/Tokyo');
        $validator = $this->validateUploadFile($request);

        if ($validator->fails() === true) {
            $response_array['status'] = 1;
            $response_array['message'] = $validator->errors()->first('csv_file');
            $characters = Character::orderBy('name', 'asc')->select(DB::raw('id, unique_id, name, gender, birth, image, decreasing_point, description'))->get()->toArray();

            return view('admin.csv-import', [
                'tab' => 'csv-import',
                'characters' => $characters
            ]);
        }

        $character_id = Character::where('unique_id', $request->ch_id)->get()->first();

        $temporary_csv_file = $request->file('csv_file')->store('csv');

        $fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');

        $headers = fgetcsv($fp);

        //$headers = mb_convert_encoding($headers, 'UTF-8');
        $import_users = array();
        while ($row = fgetcsv($fp)) {
            $row = mb_convert_encoding($row, 'UTF-8');
            $tmp = array();
            $tmp['name'] = $row[0];
            $tmp['mail'] = $row[1];
            $tmp['phone'] = $row[2];
            $tmp['age'] = $row[3];
            $tmp['birth'] = $row[4];
            $tmp['area'] = $row[5];
            $tmp['gender'] = $row[6];
            array_push($import_users, $tmp);
        }

        $message_text = $request->message_text;

        $message_arr_tmp = explode('%', $message_text);

        foreach ($import_users as $import) {

            $user = User::where('email', str_replace(' ', '', $import['mail']))->get()->first();

            $message_arr = $message_arr_tmp;
            foreach ($message_arr as $index => $str) {

                if ($str == "username") {
                    $message_arr[$index] = $import['name'];
                }
                if ($str == "usermail") {
                    $message_arr[$index] = $import['mail'];
                }
                if ($str == 'userphone') {
                    $message_arr[$index] = $import['phone'];
                }
                if ($str == 'userage') {
                    $message_arr[$index] = $import['age'];
                }
                if ($str == 'userbirth') {
                    $message_arr[$index] = date('m月d日', strtotime($import['birth']));
                }
                if ($str == 'userpref') {
                    $message_arr[$index] = $import['area'];
                }
                if ($str == 'usersex') {
                    $message_arr[$index] = $import['gender'];
                }
            }

            $content = '';
            foreach ($message_arr as $str) {
                $content = $content . $str;
            }
            if (isset($user)) {
                $data = [
                    'user_id' => $user->id,
                    'character_id' => $character_id['id'],
                    'content' => $content,
                    'type' => 'character_sent',
                    'receive_date' => date('Y-m-d H:i:s'),
                ];
                $q_id = Question::create($data)->id;
                $mail_data = [
                    'question_id' => $q_id,
                    'user_id' => $user->id,
                    'content' => mb_substr($content, 0, 20),
                    'send_time' => date('Y-m-d H:i:s'),
                ];
                Mail::create($mail_data);
            }
            else {
                if (filter_var($import['mail'], FILTER_VALIDATE_EMAIL)) {
                    if ($import['gender'] == '女性') {
                        $gender = 1;
                    } else {
                        $gender = 0;
                    }
                    $data = [
                        'name' => $import['name'],
                        'email' => str_replace(' ', '', $import['mail']),
                        'password' => Hash::make('938271'),
                        'unique_id' => rand(1000000, 9999999),
                        'mobile' => $import['phone'],
                        'role' => 'user',
                        'email_verified_at' => date('Y-m-d H:i:s'),
                        'gender' => $gender,
                        'marry' => 0,
                        'birth' => date('Y-m-d', strtotime($import['birth'])),
                        'region' => $import['area'],
                    ];

                    $nuser_id = User::create($data)->id;
//                    $nuser = User::where('email', $import['mail'])->get()->first();
                    $qdata = [
                        'user_id' => $nuser_id,
                        'character_id' => $character_id['id'],
                        'content' => $content,
                        'type' => 'character_sent',
                        'receive_date' => date('Y-m-d H:i:s'),
                    ];
                    $q_id = Question::create($qdata)->id;
                    $mail_data = [
                        'question_id' => $q_id,
                        'user_id' => $nuser_id,
                        'content' => mb_substr($content, 0, 20),
                        'send_time' => date('Y-m-d H:i:s'),
                    ];
                    Mail::create($mail_data);
                }
            }
        }
        $characters = Character::orderBy('name', 'asc')->select(DB::raw('id, unique_id, name, gender, birth, image, decreasing_point, description'))->get()->toArray();

        return view('admin.csv-import', [
            'tab' => 'csv-import',
            'characters' => $characters
        ]);
    }

    public function replyMessage()
    {
        return view('admin.reply-message', [
            'tab' => 'reply-message',
        ]);
    }

    public function digUser()
    {
        $characters = Character::orderBy('name', 'asc')->select(DB::raw('id, unique_id, name, gender, birth, image, decreasing_point, description'))->get()->toArray();

        return view('admin.dig-user', [
            'tab' => 'dig-user',
            'characters' => $characters
        ]);
    }
    public function digMessage(Request $request)
    {
        $start_money = $request->start_money;
        $end_money = $request->end_money;
        $character_id = $request->character_id;
        //$reply = $request->reply;
        $repeat = $request->repeat;
        $start_count = $request->start_count;
        if(!isset($start_count)){
            $start_count = 0;
        }
        $end_count = $request->end_count;
        if(!isset($end_count)){
            $end_count = 1000000000;
        }

        $start_last_character_send_day = $request->start_last_character_send_day;
        if(!isset($start_last_character_send_day)){
            $start_last_character_send_day = '2000-01-01 00:00:00';
        }
        else{
            $start_last_character_send_day = date('Y-m-d H:i:s', strtotime($start_last_character_send_day));
        }
        $end_last_character_send_day = $request->end_last_character_send_day;
        if(!isset($end_last_character_send_day)){
            $end_last_character_send_day = '2200-01-01 00:00:00';
        }
        else{
            $end_last_character_send_day = date('Y-m-d H:i:s', strtotime($end_last_character_send_day));
        }
        $start_point = $request->start_point;
        if(!isset($start_point)){
            $start_point = -1000000;
        }
        $end_point = $request->end_point;
        if(!isset($end_point)){
            $end_point = 1000000;
        }
        $start_last_user_send_day = $request->start_last_user_send_day;
        if(!isset($start_last_user_send_day)){
            $start_last_user_send_day = '2000-01-01 00:00:00';
        }
        else{
            $start_last_user_send_day = date('Y-m-d H:i:s', strtotime($start_last_user_send_day));
        }
        $end_last_user_send_day = $request->end_last_user_send_day;
        if(!isset($end_last_user_send_day)){
            $end_last_user_send_day = '2200-01-01 00:00:00';
        }
        else{
            $end_last_user_send_day = date('Y-m-d H:i:s', strtotime($end_last_user_send_day));
        }

        //for money credit apply
        //LEFT JOIN (SELECT COUNT(id) as cnt_money, user_id FROM point_lists GROUP BY user_id) as D ON D.user_id = B.id
        //IFNULL(E.cnt_count,0) as cnt_count

        if(isset($character_id)){

                if($repeat == 'true'){
                    $questions = DB::select("SELECT
                            A.id, A.character_id, A.user_id, A.reply, A.content, A.type, A.status, A.receive_date, A.image_url,
                            B.name as user_name, B.birth as user_birth, B.gender as user_gender, B.image as user_image, B.memo as user_memo, B.point, B.region, YEAR(CURRENT_DATE) - YEAR(B.birth) AS age,
                            C.name as character_name, C.gender as character_gender, C.image as character_image, C.description,
                            IFNULL(E.cnt_count,0) as cnt_count
                        FROM
                            questions as A
                        LEFT JOIN	users as B ON A.user_id = B.id
                        LEFT JOIN characters as C ON A.character_id = C.id
                        LEFT JOIN (SELECT COUNT(id) as cnt_count, user_id FROM questions WHERE type = 'character_sent' AND reply = 0 GROUP BY user_id) as E ON A.user_id = E.user_id
                        WHERE type = 'character_sent' AND character_id = $character_id AND cnt_count >= $start_count AND cnt_count <= $end_count
                        AND receive_date >= '$start_last_character_send_day' AND receive_date <= '$end_last_character_send_day'
                        AND receive_date >= '$start_last_user_send_day' AND receive_date <= '$end_last_user_send_day'
                        AND point >= $start_point AND point <= $end_point
                        GROUP BY user_id
                        ORDER BY A.id DESC
                    ");
                }
                else{
                    $questions = DB::select("SELECT
                            A.id, A.character_id, A.user_id, A.reply, A.content, A.type, A.status, A.receive_date, A.image_url,
                            B.name as user_name, B.birth as user_birth, B.gender as user_gender, B.image as user_image, B.memo as user_memo, B.point, B.region, YEAR(CURRENT_DATE) - YEAR(B.birth) AS age,
                            C.name as character_name, C.gender as character_gender, C.image as character_image, C.description,
                            IFNULL(E.cnt_count,0) as cnt_count
                        FROM
                            questions as A
                        LEFT JOIN	users as B ON A.user_id = B.id
                        LEFT JOIN characters as C ON A.character_id = C.id
                        LEFT JOIN (SELECT COUNT(id) as cnt_count, user_id FROM questions WHERE type = 'character_sent' AND reply = 0 GROUP BY user_id) as E ON A.user_id = E.user_id
                        WHERE type = 'character_sent' AND character_id = $character_id AND cnt_count >= $start_count AND cnt_count <= $end_count
                        AND receive_date >= '$start_last_character_send_day' AND receive_date <= '$end_last_character_send_day'
                        AND receive_date >= '$start_last_user_send_day' AND receive_date <= '$end_last_user_send_day'
                        AND point >= $start_point AND point <= $end_point
                        ORDER BY A.id DESC
                    ");
                }

        }
        else{
                if($repeat == 'true'){
                    $questions = DB::select("SELECT
                            A.id, A.character_id, A.user_id, A.reply, A.content, A.type, A.status, A.receive_date, A.image_url,
                            B.name as user_name, B.birth as user_birth, B.gender as user_gender, B.image as user_image, B.memo as user_memo, B.point, B.region, YEAR(CURRENT_DATE) - YEAR(B.birth) AS age,
                            C.name as character_name, C.gender as character_gender, C.image as character_image, C.description,
                            IFNULL(E.cnt_count,0) as cnt_count
                        FROM
                            questions as A
                        LEFT JOIN	users as B ON A.user_id = B.id
                        LEFT JOIN characters as C ON A.character_id = C.id
                        LEFT JOIN (SELECT COUNT(id) as cnt_count, user_id FROM questions WHERE type = 'character_sent' AND reply = 0 GROUP BY user_id) as E ON A.user_id = E.user_id
                        WHERE type = 'character_sent' AND cnt_count >= $start_count AND cnt_count <= $end_count
                        AND receive_date >= '$start_last_character_send_day' AND receive_date <= '$end_last_character_send_day'
                        AND receive_date >= '$start_last_user_send_day' AND receive_date <= '$end_last_user_send_day'
                        AND point >= $start_point AND point <= $end_point
                        GROUP BY user_id
                        ORDER BY A.id DESC
                    ");
                }
                else{
                    $questions = DB::select("SELECT
                            A.id, A.character_id, A.user_id, A.reply, A.content, A.type, A.status, A.receive_date, A.image_url,
                            B.name as user_name, B.birth as user_birth, B.gender as user_gender, B.image as user_image, B.memo as user_memo, B.point, B.region, YEAR(CURRENT_DATE) - YEAR(B.birth) AS age,
                            C.name as character_name, C.gender as character_gender, C.image as character_image, C.description,
                            IFNULL(E.cnt_count,0) as cnt_count
                        FROM
                            questions as A
                        LEFT JOIN	users as B ON A.user_id = B.id
                        LEFT JOIN characters as C ON A.character_id = C.id
                        LEFT JOIN (SELECT COUNT(id) as cnt_count, user_id FROM questions WHERE type = 'character_sent' AND reply = 0 GROUP BY user_id) as E ON A.user_id = E.user_id
                        WHERE type = 'character_sent' AND cnt_count >= $start_count AND cnt_count <= $end_count
                        AND receive_date >= '$start_last_character_send_day' AND receive_date <= '$end_last_character_send_day'
                        AND receive_date >= '$start_last_user_send_day' AND receive_date <= '$end_last_user_send_day'
                        AND point >= $start_point AND point <= $end_point
                        ORDER BY A.id DESC
                    ");

//                    $query = "SELECT
//                            A.id, A.character_id, A.user_id, A.reply, A.content, A.type, A.status, A.receive_date, A.image_url,
//                            B.name as user_name, B.birth as user_birth, B.gender as user_gender, B.image as user_image, B.memo as user_memo, B.point, B.region, YEAR(CURRENT_DATE) - YEAR(B.birth) AS age,
//                            C.name as character_name, C.gender as character_gender, C.image as character_image, C.description,
//                            IFNULL(E.cnt_count,0) as cnt_count
//                        FROM
//                            questions as A
//                        LEFT JOIN	users as B ON A.user_id = B.id
//                        LEFT JOIN characters as C ON A.character_id = C.id
//                        LEFT JOIN (SELECT COUNT(id) as cnt_count, user_id FROM questions WHERE type = 'character_sent' AND reply = 0 GROUP BY user_id) as E ON A.user_id = E.user_id
//                        WHERE type = 'character_sent' AND cnt_count >= $start_count AND cnt_count <= $end_count
//                        AND receive_date >= '$start_last_character_send_day' AND receive_date <= '$end_last_character_send_day'
//                        AND receive_date >= '$start_last_user_send_day' AND receive_date <= '$end_last_user_send_day'
//                        AND point >= $start_point AND point <= $end_point
//                        ORDER BY A.id DESC
//                    ";
//                    print_r($query);
//                    die();

                }
        }

//        $questions = DB::select("SELECT
//                A.id, A.character_id, A.user_id, A.reply, A.content, A.type, A.status, A.receive_date, A.image_url,
//                B.name as user_name, B.birth as user_birth, B.gender as user_gender, B.image as user_image, B.memo as user_memo, B.point, B.region, YEAR(CURRENT_DATE) - YEAR(B.birth) AS age,
//                C.name as character_name, C.gender as character_gender, C.image as character_image, C.description,
//                D.cnt_money
//            FROM
//                questions as A
//            LEFT JOIN	users as B ON A.user_id = B.id
//            LEFT JOIN characters as C ON A.character_id = C.id
//            LEFT JOIN (SELECT COUNT(id) as cnt_money, user_id FROM point_lists GROUP BY user_id) as D ON D.user_id = B.id
//            WHERE type = 'user_sent'
//            ORDER BY A.id
//        ");

        return view('admin.dig-message', [
            'questions' => $questions
        ]);
    }



    public function messageList(Request $request)
    {
        $character_id = $request->character_id;
        $member_id = $request->member_id;
        $character_name = $request->character_name;
        $member_name = $request->member_name;

        $query = Question::where('type', 'user_sent')->where('reply', '0')->leftjoin('users', 'users.id', 'questions.user_id')
            ->leftjoin('characters', 'characters.id', 'questions.character_id')
            ->select(DB::raw('users.*, characters.*, characters.unique_id as character_id, users.unique_id as member_id, characters.name as character_name, users.name as member_name,
            characters.image as character_image, users.image as user_image, characters.id as character_index, users.id as user_index,
            characters.birth as character_birth, users.birth as user_birth, questions.*, questions.id as question_id'))
            ->where('characters.unique_id', 'like', '%' . $character_id . '%')->where('users.unique_id', 'like', '%' . $member_id . '%')
            ->where('characters.name', 'like', '%' . $character_name . '%')->where('users.name', 'like', '%' . $member_name . '%')->orderBy('receive_date', 'desc');
//        print_r($query->get());
//        die();

        $messages = $query->paginate(10);
        foreach ($messages as $message) {
            $character_birth = $message->character_birth;
            $c_birthYear = date('Y', strtotime($character_birth));
            $user_birth = $message->user_birth;
            $u_birthYear = date('Y', strtotime($user_birth));
            $cur_year = date("Y");
            $message->c_age = $cur_year - $c_birthYear;
            $message->u_age = $cur_year - $u_birthYear;

            $last_login = LoginLog::where('user_id', $message->user_index)->orderBy('id', 'desc')->get()->first();
            if (isset($last_login))
                $message->last_login = $last_login->created_at;
            else
                $message->last_login = '';
            $pay_cnt = PointList::where('user_id', $message->user_index)->get()->count();
            $message->pay_cnt = $pay_cnt;
            if ($pay_cnt != 0) {
                $member_pay = PointList::where('user_id', $message->user_index)->select(DB::raw('sum(price) as price, sum(point) as point, user_id'))->groupBy('user_id')->get()->toArray();

                $message->pay = $member_pay[0]['price'];

            } else {
                $message->pay = 0;
            }
            Question::where('id', $message->question_id)->update(['status' => 'read']);
        }
        $result = $query->get()->count();
        $pagination_params = [
            'result' => $result,
            'per_page' => 10,
        ];

        return view('admin.message-list', compact('pagination_params'), [
            'tab' => 'reply-message',
            'messages' => $messages,
        ]);

    }

    public function userList(Request $request)
    {

    }

    private function validateUploadFile(Request $request)
    {
        return \Validator::make($request->all(), [
            'csv_file' => 'required|file|mimetypes:text/plain|mimes:csv,txt',
        ], [
                'csv_file.required' => 'ファイルを選択してください。',
                'csv_file.file' => 'ファイルアップロードに失敗しました。',
                'csv_file.mimetypes' => 'ファイル形式が不正です。',
                'csv_file.mimes' => 'ファイル拡張子が異なります。',
            ]
        );
    }
}
