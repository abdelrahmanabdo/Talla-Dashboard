<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\OTP;
use App\Notifications\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Handlers\OTPHandler;
use App\Handlers\SMSHandler;

class AuthController extends Controller
{
    /**
     * User login handler
     * @param \Illuminate\Http\Request $request
     */
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails())
        {
            return response([
                'success' => false,
                'errors'=>$validator->errors()->all()
            ], 422);
        }

        $user = User::whereEmail($request->email)
                    ->with(['profile', 'profile.country', 'profile.city', 'stylist'])
                    ->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [ "success" => true,
                              "message" => 'User login successfully',
                              "token" => $token,
                              "user" => $user 
                            ];
                $status_code = 200;
                
                $user->update([
                    'is_online' => 1,
                ]);

            } else {
                $response = ["success" => false,
                             "message" => "Password mismatch"];
                $status_code = 401;
            }
        } else {
            $response = ["success" => false,
                         "message" =>'User does not exist'];
            $status_code = 400;
        }
        return response($response, $status_code);

    }

    /**
     * Create new user row handler
     * @param \Illuminate\Http\Request $request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails())
        {
          return response([
              'success' => false,
              'errors'=>$validator->errors()->all(),
          ], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        // Create new user
        $user = User::create($request->toArray());
        // Get user token
        $token = $user->createToken('Tallah password')->accessToken;

        // Send welcome email to new user
        // if ($user) $user->notify(new Registration());

        $response = ['success' => true,
            'message' => 'User created successfully',
            'token' => $token,
            'user' => $user
        ];
        return response($response, 201);
    }


    /**
     * Social login handler
     * 
     */
    public function socialLogin (Request $request) {
      // Check if user has an email or not
      $user = User::whereEmail($request->email)
                    ->with(['profile', 'profile.country', 'profile.city', 'stylist'])
                    ->first();


      // User has no account so we need to create new one
      if (!$user) {
        $defaultPassword = '12345678';
        $password = Hash::make($defaultPassword);
        $user = User::create([
          'role' => 1,
          'name' => $request->name,
          'email' => $request->email,
          'password' => $password,
        ]);
      }

      $token = $user->createToken('Tallah password')->accessToken;

      $response = [
        'success' => true,
        'token' => $token,
        'user' => $user,
        'message' => 'User is authenticated successfully',
      ];
    
      $user->update([
        'is_online' => 1,
      ]);

      return response($response, 200);
    }

    // Forget Password
    public function sendForgetPasswordVerificationCode(Request $request) {
      $user = UserProfile::wherePhone($request->phone)->first();
      if (!$user) {
        return response()->json([
          'success' => false,
          'message' => 'No user with this phone number',
        ]);
      }

      $otpHandler = new OTPHandler();
      $newOTP = $otpHandler->generateOTP();
      // Save the new generated OTP code
      OTP::create([
        'user_id' => $user->user_id,
        'phone' => $user->phone,
        'code' => $newOTP,
      ]);
      // Send SMS with the code
      $message = 'Your OTP code is '. $newOTP;
      $smsHandler = new SMSHandler($message, $user->phone);

      return response()->json([
        'success' => true,
        'message' => 'OTP code is sent successfully',
        'otp' => $newOTP,
      ]);
    }

    // Update user password by phone number
    public function updateUserPasswordByPhone(Request $request) {
      $userProfile = UserProfile::wherePhone($request->phone)->first();
      if (!$userProfile) {
        return response()->json([
          'success' => false,
          'message' => 'No user with this phone number',
        ]);
      }
    
    User::whereId($userProfile->user_id)->update([
      'password' => Hash::make($request->password)
    ]);

    $user = User::whereId($userProfile->user_id)
                  ->with(['profile', 'profile.country', 'profile.city'])
                  ->first();
    $token = $user->createToken('Tallah password')->accessToken;

    return response()->json([
      'success' => true,
      'message' => 'Password was updated successfully!',
      'token' => $token,
      'user' => $user
    ]);
  }
}
