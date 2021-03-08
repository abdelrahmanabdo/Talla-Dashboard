<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1/', 'middleware' => ['cors', 'json.response']], function() {
    /**
     * Auth routes
     */
    Route::group(['prefix' => 'auth'], function() {
        //Login
        Route::post('login','AuthController@login');
        //Registration
        Route::post('register','AuthController@register');
    });


    /**
     * Secure routes
     */
    Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('stylists', 'StylistController');

        Route::apiResource('stylist-projects', 'StylistProjectController');

        // Route::apiResource('stylists.projects', 'StylistProjectController');

        Route::apiResource('stylist-certificates', 'StylistCertificateController');

        Route::apiResource('stylist-specializations', 'StylistSpecializationController');

        Route::apiResource('stylist-bank-accounts', 'StylistBankAccountController');

        /**
         * Blogs routes
         */
        Route::apiResource('blogs', 'BlogController');

        Route::apiResource('blogs.comments','BlogCommentController');

        /**
         * User profile routes
         */
        Route::apiResource('user-profile', 'UserProfileController');

        /**
         * Closet routes
         */
        Route::apiResource('closets', 'ClosetController');

        /**
         * Outfits
         */
        Route::apiResource('outfits', 'OutfitController');

        /**
         * Chats
         */
        Route::get('chats/getChats', 'ChatController@getUserChats');
        Route::get('chats/getMessages', 'ChatController@getChatMessages');
        Route::post('chats/sendNewMessage', 'ChatController@sendNewMessage');

        /**
         * Notifications
         */
        Route::apiResource('notifications', 'NotificationController');

    });


    /**
     * Public routes
     */
    Route::apiResource('specializations', 'SpecializationController');

    Route::apiResource('brands', 'BrandController');

    Route::apiResource('countries', 'CountryController');

    Route::apiResource('gifts', 'GiftController');

    Route::apiResource('categories', 'CategoryController');

    Route::apiResource('colors', 'ColorController');

    Route::apiResource('supports', 'SupportController');

    Route::apiResource('favourites', 'FavouriteController');

    Route::apiResource('registration-choices', 'RegistrationChoiceController');

    Route::apiResource('user-roles', 'UserRoleController');

    Route::get('blogs', 'BlogController@index');

    Route::get('blogs/{blog}', 'BlogController@show');

    Route::get('stylists', 'StylistController@index');

    Route::get('stylists/{stylist}', 'StylistController@show');

    Route::get('stylist-projects', 'StylistProjectController@index');

    Route::get('stylist-projects/{stylistProject}', 'StylistProjectController@show');

    Route::get('notification/test', 'NotificationController@test');

    /**
     * user devices tokens
     */
    Route::post('tokens/anonymous' , 'DeviceTokenController@addAnonymousToken');
    Route::post('tokens/user' , 'DeviceTokenController@addUserToken');
    Route::post('tokens/assign' , 'DeviceTokenController@assignUserToken');
    Route::post('tokens/unassign' , 'DeviceTokenController@unassignUserToken');
    Route::post('tokens/notification/status' , 'DeviceTokenController@changeNotificationStatus');
    Route::get('tokens/' , 'DeviceTokenController@getUserToken');

    /**
     * OTP
     */
    Route::post('otp/create', 'OTPController@create');
    Route::post('otp/validate', 'OTPController@validate');
});



