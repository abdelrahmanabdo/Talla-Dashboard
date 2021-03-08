<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\DeviceToken;

class DeviceTokenController extends Controller
{
    /**
     * Add anonymous user notification token
     */
    public function addAnonymousToken (Request $request) {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false  ,
                'message' => 'validation_error',
                'errors' => $validator->errors()
            ], 400);
        }

        $isExists = DeviceToken::whereToken($request->token)->exists();

        if($isExists){
            DeviceToken::whereToken($request->token)
                ->update([
                    'token' => null
                ]);

            return response()->json([
                'success' => false ,
                'message' => 'already_exists',
            ], 200);
        }

        $newItem = DeviceToken::create(['token' => $request->token]);

        if($newItem) {
            return response()->json([
                'success' => true  ,
                'message' => 'added_successfully',
            ], 201);
        }else{
            return response()->json([
                'success' => false ,
                'message' => 'error',
            ], 500);
        }
    }

    /**
     * Add user notification token
     */
    public function addUserToken (Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'token' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false  ,
                'message' => 'validation_error',
                'errors' => $validator->errors()
            ], 400);
        }


        $newItem = DeviceToken::create(['token' => $request->token ,
            'user_id' => $request->user_id ]);

        if($newItem) {
            return response()->json([
                'success' => true  ,
                'message' => 'added_successfully',
            ], 201);
        }else{
            return response()->json([
                'success' => false ,
                'message' => 'error',
            ], 500);
        }
    }

    /**
     * Assign user id to token
     */
    public function assignUserToken (Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'token' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false  ,
                'message' => 'validation_error',
                'errors' => $validator->errors()
            ], 400);
        }


        $token = DeviceToken::where(['token' => $request->token]);

        if($token->count() > 0) {
            $token->update(['user_id' => $request->user_id]);
            return response()->json([
                'success' => true  ,
                'message' => 'updated_successfully',
            ], 200);
        }else{
            DeviceToken::create([
                'user_id' => $request->user_id ,
                'token' => $request->token
            ]);
            return response()->json([
                'success' => true  ,
                'message' => 'added_successfully',
            ], 201);
        }
    }

    /**
     * Unassign user id to token
     */
    public function unassignUserToken (Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'token' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false  ,
                'message' => 'validation_error',
                'errors' => $validator->errors()
            ], 400);
        }

        $token = DeviceToken::where(['token' => $request->token])->first();

        if($token) {
            $token->update(['user_id' => NULL]);
            return response()->json([
                'success' => true  ,
                'message' => 'updated_successfully',
            ], 200);
        }else{
            return response()->json([
                'success' => false ,
                'message' => 'error',
            ], 500);
        }
    }

    /**
     * Get user token
     */
    public function getUserToken (Request $request) {
        $validator = Validator::make($request->all(), ['user_id' => 'required']);

        if($validator->fails()){
            return response()->json([
                'success' => false  ,
                'message' => 'validation_error',
                'errors' => $validator->errors()
            ], 400);
        }


        $data = DeviceToken::whereUserId($request->user_id)->first();

        if($data) {
            return response()->json([
                'success' => true  ,
                'data' => $data,
            ], 200);
        }else{
            return response()->json([
                'success' => false ,
                'message' => 'no_token',
            ], 500);
        }
    }

    /**
     * Change Allow Notification status
     */
    public function changeNotificationStatus (Request $request) {
        $validator = Validator::make($request->all(),
            ['token' => 'required',
                'status' => 'required'
            ]);

        if($validator->fails()){
            return response()->json([
                'success' => false  ,
                'message' => 'validation_error',
                'errors' => $validator->errors()
            ], 400);
        }


        $token = DeviceToken::whereToken($request->token)->first();

        if($token) {
            $token->update(['allow_notification' => $request->status]);

            return response()->json([
                'success' => true  ,
                'message' => 'updated_successfully',
            ], 200);
        }else{
            return response()->json([
                'success' => false ,
                'message' => 'no_token',
            ], 500);
        }
    }
}
