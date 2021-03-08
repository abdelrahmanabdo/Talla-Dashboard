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
    * Orders Handler
    */

   /**
    * new Order Handler
    */
   public function new_order (){
      $this->mobile_title = 'تم إرسال طلبك';
      $this->mobile_message = 'تم إرسال طلبك بنجاح وبأنتظار تأكيده من قبل التاجر';
      $this->merchant_message = 'لديك طلب جديد';
      $this->pushMobileNotification($this->users['user_id']);
      $this->pushWebNotification($this->users['user_id']);

   }


   /**
    * new Message Handler
    */
   public function new_message (){
      $this->mobile_title = 'رسالة من دييل';
      $this->mobile_message = $this->data['message'];
      $this->pushMobileNotification($this->users['user_id']);
   }

   /**
    * Accepting Order Handler
    */
    public function accept_order (){
      $this->mobile_title = 'تم الموافقة علي طلبك';
      $this->mobile_message = $this->data['order_code'] . ' تم الموافقة علي طلبك بنجاح من قبل التاجر وبأنتظار شحنه وكود طلبك ';
      $this->pushMobileNotification($this->users['user_id']);

   }

   /**
    * rejected Order Handler
    */
    public function reject_order (){
      $this->mobile_title = 'تم رفض طلبك ';
      $this->mobile_message = "تم رفض طلبك من قبل التاجر {$this->data['store_name']} وذلك بسبب  {$this->data['rejection_comment']}";
      $this->pushMobileNotification($this->users['user_id']);

   }

   /**
    * delivered Order Handler
    */
    public function delivered_order (){
      $this->mobile_title = ' تم وصول طلبك بنجاح 🎉 🎉 👏';
      $this->mobile_message = $this->data['order_code'] . ' تم وصول طلبك بنجاح شكرا لك علي استخدام ابلكيشن ديل ❤️  ';
      $this->pushMobileNotification($this->users['user_id']);

   }

   /**
    * shipped Order Handler
    */
    public function ship_order (){
      $this->mobile_title = 'تم شحن طلبك ';
      $this->mobile_message = $this->data['order_code'].' تم شحن طلبك من قبل شركة الشحن بكود ';
      $this->pushWebNotification($this->users['user_id']);

   }

   /**
    * Products
    */

   /**
    * New Product Handler
    */
    public function new_product (){
      $this->mobile_title = "{$this->data['store_name']}";
      $this->mobile_message = "تم إضافة .. {$this->data['product_name']} بسعر {$this->data['product_price']} جنية";
      $this->pushMobileNotification($this->users['user_id']);
   }


   /**
    * Offers
    */
    public function new_offer (){
      $this->mobile_title = 'عرض جديد !!';
      $this->mobile_message = 'تم نشر عرض جديد  .. كن أول المستخدمين له';
      $this->pushMobileNotification($this->users['user_id']);
   }

   /**
    * Shipping Requests
    */
   /**
    * new Order Handler
    */
    public function new_shipping_request (){
      $this->merchant_message = 'تم إرسال  طلب شحن جديد من قبل تاجر';
      $this->pushWebNotification($this->users['admin_id']);
   }

   /**
    * Accepting Order Handler
    */
    public function accept_shipping_request(){
      $this->merchant_message = $this->data['order_code'] . ' تم الموافقة علي طلب الشحن بنجاح من قبل جوجا لتوصيل الطلب رقم  ';
      $this->mobile_title = 'تم الموافقة علي شحن الطلب !!';
      $this->mobile_message = 'تم الموافقة علي شحن الطلب من قبل شركة الشحن وسيصلك في اقرب وقت';
      $this->pushMobileNotification($this->users['user_id']);
      $this->pushWebNotification($this->users['user_id']);

   }

   /**
    * rejected Order Handler
    */
    public function reject_shipping_request (){
      $this->merchant_message = 'تم رفض طلب الشحن من قبل جوجا لأنشغالهم في العديد من الطلبات الأن';
      $this->pushWebNotification($this->users['store_id']);

   }

   /**
    * Change store Auth request status
    */
    public function change_auth_request_status (){
      $store_name =  $this->data["store_name"] ?? "";
      $this->mobile_title = $this->data['status'] == 1  ? ' تم الموافقة علي طلب عرض الأسعار !!' : ' تم رفض طلب عرض السعر من قبل التاجر';
      $this->mobile_message =  $this->data['status'] == 1 ?   " تم الموافقة علي طلب توثيقك مع التاجر  {$store_name} "
                                                          :  " تم رفض طلبك لرؤية الأسعار من قبل التاجر  {$store_name} ";
      $this->pushMobileNotification($this->users['user_id']);
   }


   /**
    * Change merchant request status
    */
    public function change_merchant_request_status (){
      $this->mobile_title = $this->data['status'] == 1  ? "تم الموافقة علي طلب إنشاء متجرك"
                                                          : "تم رفض طلب إنشاء متجرك";
      $this->mobile_message =  $this->data['status'] == 1 ?  'مبروك , تم تفعيل حسابك كمورد, رجاء التواصل مع خدمة العملاء لمساعدتك في تنسيق عرض منتجاتك'
                                                              : "تم رفض طلب إنشاء متجرك وذلك بسبب {$this->data['rejection_comment']} " ;
      $this->pushMobileNotification($this->users['user_id']);
   }





   /**
    * Handlers
    */

   /**
    * Push Norification to web app
    */
//   public function pushWebNotification ($user_id) {
//
//      $options = array(
//        'cluster' => 'eu',
//        'useTLS' => true
//      );
//      $pusher = new Pusher\Pusher(
//        '3ce59af96c324e631e9d',
//        '2dd8fc2995d2e45f3863',
//        '1048589',
//        $options
//      );
//
//      $data['message'] = $this->merchant_message ?? '';
//      $data['user_id'] = $user_id;
//      $data['orders_url'] = '/orders';
//      $data['shipping_url'] = '/shippings';
//
//      $pusher->trigger('merchant-channel',$this->type, $data);
//
//   }


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
