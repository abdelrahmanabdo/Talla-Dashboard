<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    /**
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
            return response(['success' => false, 'errors'=>$validator->errors()->all()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['success' => true, 'message' => 'User login successfully', 'token' => $token, 'user' => $user];
                return response($response, 200);
            } else {
                $response = ['success' => false, "message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ['success' => false, "message" =>'User does not exist'];
            return response($response, 422);
        }

    }

    /**
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
            return response(['success' => false, 'errors'=>$validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Tallah password')->accessToken;
        $response = ['success' => true, 'token' => $token , 'message' => 'User created successfully' , 'user' => $user];

        return response($response, 200);
    }

}
