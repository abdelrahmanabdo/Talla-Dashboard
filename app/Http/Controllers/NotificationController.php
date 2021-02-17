<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Handlers\NotificationHandler;

class NotificationController extends Controller
{

    /**
     *  test notifications
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
                new NotificationHandler('new_order',
                                       array('user_id'=>[2 ,'store_id' => 1]),
                                       array('order_code'=> 141414124));

        return response([
            'success' => false,
            'mesage'  => 'New OTP valid for 10 mins only',
            'data'    => $newOtp
        ],200);
    }



}
