<?php

use Illuminate\Support\Facades\Mail;

function sendVerifyEmail($code, $email){
    $details = array(
        'code'=> $code,
        'title'=>'このメールは送信専用です。'
    );
    Mail::to($email)->send(new \App\Mail\VerifyEmail($details));
}

function sendResetEmail($token, $email){
    $details = array(
        'url'=> url('/password/reset/' . $token)
    );
    Mail::to($email)->send(new \App\Mail\ResetPasswordEmail($details));
}
function sendBankPort($code, $email){
    $details = array(
        'bank_port'=> $code,
        'title'=>'Send Bank Port'
    );
    Mail::to($email)->send(new \App\Mail\SendBankPort($details));
}
function sendReceivedMail($character_name, $email, $content){
    $details = array(
        'character_name'=> $character_name,
        'email' => $email,
        'content' => $content
    );
    Mail::to($email)->send(new \App\Mail\ReceivedMail($details));
}
function sendReceivedMailCsv($character_name, $email, $pw){
    $details = array(
        'character_name'=> $character_name,
        'pw' => $pw,
        'email' => $email,
    );
    Mail::to($email)->send(new \App\Mail\ReceivedMailCsv($details));
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
