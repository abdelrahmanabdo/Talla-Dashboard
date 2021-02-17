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
        //Register
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
     * OTP
     */
    Route::post('otp/create', 'OTPController@create');
    Route::post('otp/validate', 'OTPController@validate');
});



