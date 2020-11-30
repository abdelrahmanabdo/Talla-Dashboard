<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\UserProfileResource
     */
    public function index(Request $request)
    {
        $userProfiles = UserProfile::all();

        return new UserProfileResource($userProfiles);
    }

    /**
     * @param \App\Http\Requests\UserProfileRequest $request
     * @return \App\Http\Resources\UserProfileResource
     */
    public function store(UserProfileRequest $request)
    {
        $userProfile = UserProfile::create($request->validated());

        return new UserProfileResource($userProfile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\userProfile $userProfile
     * @return \App\Http\Resources\UserProfileResource
     */
    public function show(Request $request, UserProfile $userProfile)
    {
        return new UserProfileResource($userProfile);
    }

    /**
     * @param \App\Http\Requests\UserProfileRequest $request
     * @param \App\userProfile $userProfile
     * @return \App\Http\Resources\UserProfileResource
     */
    public function update(Request $request, UserProfile $userProfile)
    {  
        $userProfile->update($request->all());

        return new UserProfileResource($userProfile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\userProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserProfile $userProfile)
    {
        $userProfile->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
