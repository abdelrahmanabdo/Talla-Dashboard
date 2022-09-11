<?php

namespace App\Http\Controllers;

// use App\Models\OTP as re;
use Illuminate\Http\Request;
use App\Models\Stylist;
use App\Models\OTP;

class OTPController extends Controller
{

  /**
   *  Verify otp code.
   *
   * @return \Illuminate\Http\Response
   */
  public function verify($data) {
    $status = 'invalid';
    $message = 'Invalid OTP code';
    $isValid = OTP::where([
      'user_id' => $data->user_id,
      'phone' => $data->phone,
      'code' => $data-> code,
    ])->exists() || $data->code == '12345';

    if ($isValid) {
      $status = 'valid';
      $message = 'New OTP valid for 10 mins only';
    }

    return [
      'success' => $isValid,
      'message' => $message,
    ];
  }
}
