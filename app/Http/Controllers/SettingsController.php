<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Http\Requests\SettingsRequest;
use App\Http\Resources\SettingsResource;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
   /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ColorCollection
     */
    public function index(Request $request)
    {
        $settings = Settings::first();

        return new SettingsResource($settings);
    }

    /**
     * @param \App\Http\Requests\SettingsResource $request
     * @return \App\Http\Resources\SettingsResource
     */
    public function store(SettingsRequest $request)
    {
        $settings = Settings::create($request->validated());

        return new SettingsResource($settings);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Settings $settings
     * @return \App\Http\Resources\SettingsResource
     */
    public function show(Request $request, Settings $settings)
    {
        return new SettingsResource($settings);
    }

    /**
     * @param \App\Http\Requests\ColorUpdateRequest $request
     * @param \App\Settings $settings
     * @return \App\Http\Resources\SettingsResource
     */
    public function update(Request $request, Settings $settings)
    {
        $settings->update($request->all());

        return new SettingsResource($settings);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Settings $settings)
    {
        $settings->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
