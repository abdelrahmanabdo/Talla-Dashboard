<?php

namespace App\Handlers;

use Twilio\Rest\Client;

class SMSHandler {

  public $message ;

  public $recipients ;

  /**
    * Create a new SMS instance.
    *
    * @return void
    */
  public function __construct($message, $recipients) {
    $this->message = $message;
    $this->recipients = $recipients;
    $this->sendMessage($this->message, $this->recipients);
  }


  /**
   * Sends sms to user using Twilio's programmable sms client
   * @param String $message Body of sms
   * @param Number $recipients string or array of phone number of recepient
   */
  private function sendMessage($message, $recipients) {
      $account_sid = getenv("TWILIO_SID");
      $auth_token = getenv("TWILIO_AUTH_TOKEN");
      $twilio_number = getenv("TWILIO_NUMBER");
      $client = new Client($account_sid, $auth_token);
      $client->messages->create($recipients,
         ['from' => $twilio_number, 'body' => $message]);
  }


}