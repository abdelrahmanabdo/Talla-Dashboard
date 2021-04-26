<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * User login handler
     * @param \Illuminate\Http\Request $request
     */
    public function login(Request $request)
    {
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
                    ->with(['profile', 'profile.country', 'profile.city'])
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
            return response(['success' => false,
                             'errors'=>$validator->errors()->all()
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
            'token' => $token ,
            'user' => $user
        ];
        return response($response, 201);
    }

}
