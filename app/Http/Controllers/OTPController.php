<?php

namespace App\Http\Controllers;

// use App\Models\OTP as re;
use Illuminate\Http\Request;
use Otp;

class OTPController extends Controller
{

    /**
     *  Create new otp token.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'phone' => ['required'],
        ]);
        
        $newOtp = Otp::generate($request->phone, 6, 10);

        return response([
            'success' => false,
            'mesage'  => 'New OTP valid for 10 mins only',
            'data'    => $newOtp
        ],200);
    }



}
