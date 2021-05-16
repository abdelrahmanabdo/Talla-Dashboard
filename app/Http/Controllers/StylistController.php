<?php

namespace App\Http\Controllers;

use App\Http\Requests\StylistRequest;
use App\Http\Resources\StylistCollection;
use App\Http\Resources\StylistResource;
use App\Models\Stylist;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;

class StylistController extends Controller
{
    use StoreImageTrait;
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\StylistCollection
     */
    public function index(Request $request)
    {
        $stylists = Stylist::all();

        return new StylistCollection($stylists);
    }

    /**
     * @param \App\Http\Requests\StylistRequest $request
     * @return \App\Http\Resources\StylistResource
     */
    public function store(StylistRequest $request)
    {
        /**
         * Store stylist avatar
         */
        if ($request->avatar) {
            $imagePath = $this->verifyAndStoreImage($request->avatar, $request->user_id , 'users');
            $request->merge([
                'avatar' => $imagePath
            ]);
        }

       //Check if user already has a stylist profile
       /**
        * Update current stylist profile
        */
        if ($isStylistData = Stylist::whereUserId($request->user_id)->first()) {
            $isStylistData->update($request->all());
            $stylist = $isStylistData;
        } 

        /**
         * Create new stylist profile
         */
        else {
          $stylist = Stylist::create($request->all());
        }

        return new StylistResource($stylist);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylist $stylist
     * @return \App\Http\Resources\StylistResource
     */
    public function show(Request $request, Stylist $stylist)
    {
        return new StylistResource($stylist);
    }
    
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylist $stylist
     * @return \App\Http\Resources\StylistResource
     */
    public function update(Request $request, Stylist $stylist)
    {
        $stylist->update($request->all());

        return new StylistResource($stylist);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylist $stylist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Stylist $stylist)
    {
        $stylist->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
