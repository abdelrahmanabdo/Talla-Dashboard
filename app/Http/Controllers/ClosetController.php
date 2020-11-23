<?php

namespace App\Http\Controllers;

use App\Models\Closet;
use App\Http\Requests\ClosetStoreRequest;
use App\Http\Requests\ClosetUpdateRequest;
use App\Http\Resources\ClosetCollection;
use App\Http\Resources\ClosetResource;
use Illuminate\Http\Request;

class ClosetController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ClosetCollection
     */
    public function index(Request $request)
    {
        $closets = Closet::all();

        return new ClosetCollection($closets);
    }

    /**
     * @param \App\Http\Requests\ClosetStoreRequest $request
     * @return \App\Http\Resources\ClosetResource
     */
    public function store(ClosetStoreRequest $request)
    {
        $closet = Closet::create($request->validated());

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
     * @param \App\Http\Requests\ClosetUpdateRequest $request
     * @param \App\closet $closet
     * @return \App\Http\Resources\ClosetResource
     */
    public function update(ClosetUpdateRequest $request, Closet $closet)
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

        return response()->noContent();
    }
}
