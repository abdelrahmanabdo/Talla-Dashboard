<?php

namespace App\Handlers;


use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
//use Pusher;
use \App\Models\DeviceToken;

class NotificationHandler {

   public $type ;

   public $data ;

   public $users;

   public $mobile_title ;

   public $mobile_message ;

   public $merchant_message;


   /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type , $users , $data = [])
    {
      $this->type = $type ;
      $this->users = $users ;
      $this->data = $data ;

      //Notification type
      $this->$type();
    }


   /**
    * new Message Handler
    */
   public function new_message (){
      $this->mobile_title = 'رسالة جديدة';
      $this->mobile_message = $this->data['message'];
      $this->pushMobileNotification($this->users['user_id']);
   }

   /**
     * Push Notifications to device
     */
   public function pushMobileNotification ($users) {

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder($this->mobile_title);
      $notificationBuilder->setBody($this->mobile_message)
                         ->setSound('default');

      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData(['a_data' => 'my_data']);

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();

      // You must change it to get your tokens
      $tokens = DeviceToken::whereIn('user_id', $users)
                                ->pluck('token')
                                ->toArray();

      $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();

      // return Array - you must remove all this tokens in your database
      $downstreamResponse->tokensToDelete();

      // return Array (key : oldToken, value : new token - you must change the token in your database)
      $downstreamResponse->tokensToModify();

      // return Array - you should try to resend the message to the tokens in the array
      $downstreamResponse->tokensToRetry();

      // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
      $downstreamResponse->tokensWithError();
   }
}
