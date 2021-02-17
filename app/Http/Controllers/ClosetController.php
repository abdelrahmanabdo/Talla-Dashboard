<?php

namespace App\Http\Controllers;

use App\Models\Closet;
use App\Http\Requests\ClosetRequest;
use App\Http\Resources\ClosetCollection;
use App\Http\Resources\ClosetResource;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;

class ClosetController extends Controller
{
    use StoreImageTrait;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ClosetCollection
     */
    public function index(Request $request)
    {
        // Filter closet rows acording to type (item , outfit)
        $closets = Closet::when(!empty($request->category_id) && $request->category_id !== 'null' , function($q) use($request){
                                    $q->where('category_id', $request->category_id);
                                })
                            ->when(!empty($request->season) && $request->season !== 'null' , function($q) use($request){
                                    $q->where('season', $request->season);
                                })
                            ->get();

        return new ClosetCollection($closets);
    }

    /**
     * @param \App\Http\Requests\ClosetRequest $request
     * @return \App\Http\Resources\ClosetResource
     */
    public function store(ClosetRequest $request)
    {
        /**
         * Store item image
         */
        if ($request->image) {
            $imagePath = $this->verifyAndStoreBase64Image($request->image, $request->user_id . '-item' , 'closets');
            $request->merge([
                'image' => $imagePath
            ]);
        }

        $closet = Closet::create($request->all());

        return new ClosetResource($closet);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\closet $closet
     * @return \App\Http\Resources\ClosetResource
     */
    public function show(Request $request, Closet $closet)
    {
        return new ClosetResource($closet);
    }

    /**
     * @param \App\Http\Requests\ClosetRequest $request
     * @param \App\closet $closet
     * @return \App\Http\Resources\ClosetResource
     */
    public function update(ClosetRequest $request, Closet $closet)
    {
        $closet->update($request->validated());

        return new ClosetResource($closet);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\closet $closet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Closet $closet)
    {
        $closet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);    
    }
}
