<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileStoreRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Http\Resources\UserProfileCollection;
use App\Http\Resources\UserProfileResource;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\UserProfileCollection
     */
    public function index(Request $request)
    {
        $userProfiles = UserProfile::all();

        return new UserProfileCollection($userProfiles);
    }

    /**
     * @param \App\Http\Requests\UserProfileStoreRequest $request
     * @return \App\Http\Resources\UserProfileResource
     */
    public function store(UserProfileStoreRequest $request)
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
     * @param \App\Http\Requests\UserProfileUpdateRequest $request
     * @param \App\userProfile $userProfile
     * @return \App\Http\Resources\UserProfileResource
     */
    public function update(UserProfileUpdateRequest $request, UserProfile $userProfile)
    {
        $userProfile->update($request->validated());

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

        return response()->noContent();
    }
}
