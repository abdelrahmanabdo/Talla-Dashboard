<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Http\Requests\FavouriteRequest;
use App\Http\Resources\FavouriteResource;
use App\Http\Resources\FavouriteCollection;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\FavouriteCollection
     */
    public function index(Request $request)
    {
        $countries = Favourite::with(['item'])->get();

        return new FavouriteCollection($countries);
    }

    /**
     * @param \App\Http\Requests\FavouriteRequest $request
     * @return \App\Http\Resources\FavouriteResource
     */
    public function store(FavouriteRequest $request)
    {
        /**
         * Check if item already added before
         */
        $item = Favourite::where(['user_id' => $request->user_id, 'closet_id' => $request->closet_id])->first();
         
        if ($item) {
            // Delete item if exists and user clicked twice on it
            if ($request->remove_item == 1) {
                $item->delete();
                return response([
                    'success' => true,
                    'message' => 'item removed from favourites'
                ]);
            }

            return response([
                'success' => true,
                'message' => 'item is already added before'
            ]);
        }
        
        $favourite = Favourite::create($request->validated());

        return new FavouriteResource($favourite);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\favourite $favourite
     * @return \App\Http\Resources\FavouriteResource
     */
    public function show(Request $request, Favourite $favourite)
    {
        return new FavouriteResource($favourite);
    }

    /**
     * @param \App\Http\Requests\FavouriteUpdateRequest $request
     * @param \App\favourite $favourite
     * @return \App\Http\Resources\FavouriteResource
     */
    public function update(Request $request, Favourite $favourite)
    {
        $favourite->update($request->all());

        return new FavouriteResource($favourite);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\favourite $favourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Favourite $favourite)
    {
        $favourite->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);    
    }
}
