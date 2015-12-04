<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\AppController;

class SendRegistrationEmail extends AppController
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public $userName, $userEmail, $opt;
  public function __construct()
  {

  }

  /**
   * Handle the event.
   *
   * @param  UserRegistered  $event
   * @return void
   */
  public function handle(UserRegistered $event)
  {
    (new AppController)->shootEmail($event->userData['email'], $event->userData['name'], 'MockBank - Registration Successful', ['otp' => $event->userData['otp'], 'name' => $event->userData['name']], 'emails.user-registered');
  }

  // public function shootEmail(AppController $appController) {
  //   $emailData = $this->emailData;
  //   return $email->send('emails.user-registered', $emailData, function($message) use($emailData) {
  //     $message->from('info@mockbank.com', 'MockBank');
  //     $message->to($emailData['email'], $emailData['name'])->subject('MockBank - Registration Successful');      
  //   });
  // }
}
