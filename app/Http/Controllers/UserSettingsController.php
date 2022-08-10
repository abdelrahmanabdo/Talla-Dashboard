<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = UserSettings::updateOrCreate([ 'user_id' => $request->user_id], $request->all());
      return response()->json([
        'success' => true,
        'data' => $data,
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      $settings = UserSettings::whereUserId($request->user_id)->first();

      return response()->json([
        'status' => true,
        'data' => $settings,
      ]);
    }
}
