<?php

namespace App\Http\Controllers;

use App\Models\Outfit;
use App\Models\ClosetOutfitItem;
use App\Http\Requests\OutfitRequest;
use App\Http\Resources\OutfitCollection;
use App\Http\Resources\OutfitResource;
use Illuminate\Http\Request;
use Exception ;

class OutfitController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\OutfitCollection
     */
    public function index(Request $request)
    {
      if (!$request->user_id) return response()->json(['message' => 'User id is required'], 422);
      $outfits = Outfit::with(['items', 'items.closetItem'])
                      ->whereUserId($request->user_id)
                      ->get();
      return new OutfitCollection($outfits);
    }

    /**
     * @param \App\Http\Requests\OutfitRequest $request
     * @return \App\Http\Resources\OutfitResource
     */
    public function store(OutfitRequest $request)
    {
        // Get the last added outfit for the user to increment it 
        $lastUserOutfitGroup = Outfit::whereUserId($request->user_id)->latest('id')->value('group');
        
        // Increment last group by 1
        $lastUserOutfitGroup = ++$lastUserOutfitGroup ?? 1;
        $outfit = Outfit::create([
                    'user_id' => $request->user_id,
                    'group' => $lastUserOutfitGroup,
                ]);
        // Iterate over items array
        foreach ($request->items as $item) {
            try {
                ClosetOutfitItem::create([
                    'outfit_id' => $outfit->id,
                    'closet_item_id' => $item
                ]);
            } catch(Exception $e) {
                return response([
                    'success' => false,
                    'message' => 'Items ids are not right !!'
                ],500);
            }
        }

        return new OutfitResource($outfit);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Outfit $Outfit
     * @return \App\Http\Resources\OutfitResource
     */
    public function show(Request $request, Outfit $Outfit)
    {
        return new OutfitResource($Outfit);
    }

    /**
     * @param \App\Http\Requests\OutfitRequest $request
     * @param \App\Outfit $Outfit
     * @return \App\Http\Resources\OutfitResource
     */
    public function update(OutfitRequest $request, Outfit $Outfit)
    {
        $Outfit->update($request->validated());

        return new OutfitResource($Outfit);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Outfit $Outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Outfit $Outfit)
    {
        $Outfit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);    
    }
}
