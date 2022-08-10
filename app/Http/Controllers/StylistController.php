<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OTPController;
use App\Http\Requests\StylistRequest;
use App\Http\Resources\StylistCollection;
use App\Http\Resources\StylistResource;
use App\Models\User;
use App\Models\Stylist;
use App\Models\OTP;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;

use App\Handlers\OTPHandler;
use App\Handlers\SMSHandler;

class StylistController extends Controller
{
  use StoreImageTrait;
  /**
   * @param \Illuminate\Http\Request $request
   * @return \App\Http\Resources\StylistCollection
   */
  public function index(Request $request)
  {
      $stylists = Stylist::whereActive(1)->get();

      return new StylistCollection($stylists);
  }

  /**
   * @param \App\Http\Requests\StylistRequest $request
   * @return \App\Http\Resources\StylistResource
   */
  public function store(StylistRequest $request)
  {
      /**
      * Store stylist avatar
      */
      if ($request->avatar) {
          $imagePath = $this->verifyAndStoreImage($request->avatar, $request->user_id , 'users/stylist');
          $request->merge([
              'avatar' => $imagePath
          ]);
      }

      //Check if user already has a stylist profile
      /**
      * Update current stylist profile
      */
      if ($stylistData = Stylist::whereUserId($request->user_id)->first()) {
          $stylistData->update($request->all());
          $stylist = $stylistData;
      }

      /**
       * Create new stylist profile
       */
      else {
        $stylist = Stylist::create($request->all());
        // Send OTP code
        if ($stylist) {
          $phone = $stylist->mobile_numbers[0];
          $otpHandler = new OTPHandler();
          $newOTP = $otpHandler->generateOTP();
          // Save the new generated OTP code
          OTP::create([
            'user_id' => $stylist->user_id,
            'phone' => $phone,
            'code' => $newOTP,
          ]);
          // Send SMS with the code
          $message = 'Your OTP code is '. $newOTP;
          $smsHandler = new SMSHandler($message, $phone);
          // Update user role 
          User::find($request->user_id)->update(['role_id' => 2]);
        }
      }

      return new StylistResource($stylist);
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @param \App\stylist $stylist
   * @return \App\Http\Resources\StylistResource
   */
  public function show(Request $request, Stylist $stylist)
  {
      return new StylistResource($stylist);
  }
  
  /**
   * @param \Illuminate\Http\Request $request
   * @param \App\stylist $stylist
   * @return \App\Http\Resources\StylistResource
   */
  public function update(Request $request, Stylist $stylist)
  {   
      if ($request->avatar && !is_string($request->avatar)) {
          $imagePath = $this->verifyAndStoreImage($request->avatar, $request->user_id , 'users/stylist');
          $request->merge([
              'avatar' => $imagePath
          ]);
      }
      
      $stylist->update($request->all());

      return new StylistResource($stylist);
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @param \App\stylist $stylist
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, Stylist $stylist)
  {
      $stylist->delete();

      return response()->json([
          'status' => true,
          'message' => 'Deleted successfully'
      ]);
  }


  /**
   *  Verify stylist otp code.
   *
   * @return \Illuminate\Http\Response
   */
  public function verifyStylistPhone(Request $request) {
    $otpController = new OTPController();
    $isValidOTP = $otpController->verify($request);
    if ($isValidOTP['success']) {
      Stylist::whereUserId($request->user_id)->update([
        'is_approved' => true,
        'active' => true,
      ]);
    }

    return response([
      'success' => $isValidOTP['success'],
      'message'  => $isValidOTP['message'],
      'data'    => Stylist::whereUserId($request->user_id)->first(),
    ],200);
  }
}
