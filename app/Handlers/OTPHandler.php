<?php

namespace App\Handlers;

class OTPHandler {

  protected $length;
  /**
    *
    * @return void
    */
  public function __construct($length = 5) {
    $this->length = $length;
  }


  /**
   * Generate unique OTP
   */
  public function generateOTP() {
    $generator = "1357902468";
    $result = "";
    for ($i = 1; $i <= $this->length; $i++) {
      $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
    return $result;
  }

}