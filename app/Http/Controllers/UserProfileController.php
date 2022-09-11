<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\RegistrationChoice;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;
use Mail;

class UserProfileController extends Controller
{
    use StoreImageTrait;
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
        /**
         * Store user avatar
         */
        if ($request->avatar) {
            $imagePath = $this->verifyAndStoreImage($request->avatar, $request->user_id , 'users');
            $request->merge([
                'avatar' => $imagePath
            ]);
        }

       // Update current user
        if ($user = UserProfile::whereUserId($request->user_id)->first()) {
            $user->update($request->all());
            $userProfile = $user;
        } 
        // Create new user
        else $userProfile = UserProfile::create($request->all());
        
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

        /**
         * Store user avatar
         */
        if ($request->avatar) {
            $imagePath = $this->verifyAndStoreImage($request->avatar, $request->user_id , 'users');
            $request->merge([
                'avatar' => $imagePath
            ]);
        }

        $userProfile->update($request->all());
            
        if ($request->step === 'bodyShape' || $request->step === 'skinGlow') {
            $this->sendEmail($request);
        }

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
    
    private function sendEmail($request) {
        $email = User::find($request->user_id)->email;
        if (!$email) {
            return;
        }

        if ($request->step == 'bodyShape') {
            $bodyShapeTitle = RegistrationChoice::find($request->body_shape_id)->title;
            
            Mail::to($email)->send(new \App\Mail\BodyShape([ 'type' => $bodyShapeTitle ]));            
        } else if ($request->step === 'skinGlow') {
            $skinTitle = RegistrationChoice::find($request->skin_glow_id)->title;
            $type = explode(" ", $skinTitle);

            Mail::to($email)->send(new \App\Mail\SkinGlow([ 'type' => $type[0] ]));      
        }
    }
}
