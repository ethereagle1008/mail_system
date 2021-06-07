<?php

namespace App\Console\Commands;

use App\Character;
use App\Mail;
use App\Question;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail';

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
        Mail::where('send_time', '<', date('Y-m-d H:i:s'))->where('status', 'nosent')->orderBy('id')->chunkById(500, function ($mails) {
            foreach ($mails as $mail) {
                $q_id = $mail->question_id;
                $q = Question::where('id', $q_id)->get()->first();
                $character = Character::where('id', $q->character_id)->get()->first();
                $user = User::where('id', $mail->user_id)->get()->first();
                if(isset($character) && isset($user)){
                    Log::warning('Cron sendReceivedMail by immediately: character_name:' . $character->name . ' email:' . $user->email . 'content: '. $mail->content);
                    if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                        sendReceivedMail($character->name, $user->email, $mail->content);
                        DB::table('mails')
                            ->where('id', $mail->id)
                            ->update(['status' => 'sent']);
                    }
                }
            }
        });

        return 0;
    }
}
