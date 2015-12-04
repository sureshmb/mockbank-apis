<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
  public function generateOtp($length = 6) {
    $chars = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
    $charsLength = strlen($chars);
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
      $otp .= $chars[rand(0, $charsLength - 1)];
    }
    return $otp;
  }
  
  public function shootEmail($toEmail, $toName, $emailSubject, $emailContent, $emailView, $fromEmail = 'info@mockbank.com', $fromName = 'MockBank') {
    $send = \Mail::send($emailView, $emailContent, function($message) use($toEmail, $toName,$fromEmail,$fromName, $emailSubject) {
      $message->from($fromEmail, $fromName);
      $message->to($toEmail, $toName)->subject($emailSubject);      
    });    
  }
}
