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

/**
 * Auth Routes
 */

Route::group(['prefix' => 'auth'], function() {
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('user-role', 'UserRoleController');

Route::apiResource('specialization', 'SpecializationController');

Route::apiResource('brand', 'BrandController');

Route::apiResource('country', 'CountryController');

Route::apiResource('gift', 'GiftController');

Route::apiResource('category', 'CategoryController');

Route::apiResource('color', 'ColorController');

Route::apiResource('support', 'SupportController');

Route::apiResource('registration-choice', 'RegistrationChoiceController');

Route::apiResource('stylist', 'StylistController');

Route::apiResource('stylist-certificate', 'StylistCertificateController');

Route::apiResource('stylist-project', 'StylistProjectController');

Route::apiResource('stylist-specialization', 'StylistSpecializationController');

Route::apiResource('stylist-bank-account', 'StylistBankAccountController');

Route::apiResource('blog', 'BlogController');

Route::apiResource('user-profile', 'UserProfileController');

Route::apiResource('closet', 'ClosetController');

