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

Route::group(['middleware' => ['cors', 'json.response']], function() {
    /**
     * Auth routes
     */
    Route::group(['prefix' => 'auth'], function() {
        //Login
        Route::post('login','AuthController@login');
        // Social login
        Route::post('social-login','AuthController@socialLogin');
        //Registration
        Route::post('register','AuthController@register');
    });


    /**
     * Secure routes
     */
    Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('stylists', 'StylistController');

        // Route::apiResource('stylist-projects', 'StylistProjectController');

        // Route::apiResource('stylists.projects', 'StylistProjectController');

        Route::apiResource('stylist-certificates', 'StylistCertificateController');

        Route::apiResource('stylist-specializations', 'StylistSpecializationController');

        Route::apiResource('stylist-bank-accounts', 'StylistBankAccountController');
        
        Route::post('stylists/otp/verify', 'StylistController@verifyStylistPhone');

        //Blogs routes
        Route::apiResource('blogs', 'BlogController');

        Route::apiResource('blogs.comments','BlogCommentController');

        //User profile routes
        Route::apiResource('user-profile', 'UserProfileController');

        //Closet routes
        Route::apiResource('closets', 'ClosetController');

        // Outfits
        Route::apiResource('outfits', 'OutfitController');

        // Calendar
        Route::apiResource('calendar', 'CalendarController');

        //Chats
        Route::get('/chats', 'ChatController@getUserChats');
        Route::get('chats/messages', 'ChatController@getChatMessages');
        Route::post('chats/send', 'ChatController@sendNewMessage');

        //Notifications
        Route::apiResource('notifications', 'NotificationController');

        // User settings
        Route::get('user-settings','UserSettingsController@show');
        Route::post('user-settings/upsert-settings','UserSettingsController@store');

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
    
    Route::get('blogs/details/{slug}', 'BlogController@getBlogBySlug');

    Route::apiResource('blogs.reviews','BlogReviewController');

    Route::get('stylists', 'StylistController@index');

    Route::get('stylists/{stylist}', 'StylistController@show');

    Route::get('stylist-projects', 'StylistProjectController@index');
    
    Route::get('stylist-projects/{stylistProject}', 'StylistProjectController@show');
    
    Route::delete('stylist-projects/{stylistProject}', 'StylistProjectController@destroy');

    Route::get('notification/test', 'NotificationController@test');

    Route::apiResource('about', 'AboutUsController');

    Route::apiResource('T&C', 'TAndCController');

    Route::apiResource('settings', 'SettingsController');

    Route::post('user-settings/delete/account', 'SettingsController@deleteAccount');

    Route::apiResource('subscription', 'SubscriptionController');


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
    Route::post('otp/verify', 'OTPController@verify');


    /**
     * Forget Password 
     */
    Route::post('forget-password','AuthController@sendForgetPasswordVerificationCode');
    Route::post('forget-password/update-password','AuthController@updateUserPasswordByPhone');
});


Route::group([
    'prefix'     => 'orders',
    'as'         => 'order.',
    'middleware' => 'auth',
], function () {
    ctf0\PayMob\PayMobRoutes::routes();
});