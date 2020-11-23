<?php

namespace App\Http\Controllers;

use App\Gift;
use App\Http\Requests\GiftStoreRequest;
use App\Http\Requests\GiftUpdateRequest;
use App\Http\Resources\GiftCollection;
use App\Http\Resources\GiftResource;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\GiftCollection
     */
    public function index(Request $request)
    {
        $gifts = Gift::all();

        return new GiftCollection($gifts);
    }

    /**
     * @param \App\Http\Requests\GiftStoreRequest $request
     * @return \App\Http\Resources\GiftResource
     */
    public function store(GiftStoreRequest $request)
    {
        $gift = Gift::create($request->validated());

        return new GiftResource($gift);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\gift $gift
     * @return \App\Http\Resources\GiftResource
     */
    public function show(Request $request, Gift $gift)
    {
        return new GiftResource($gift);
    }

    /**
     * @param \App\Http\Requests\GiftUpdateRequest $request
     * @param \App\gift $gift
     * @return \App\Http\Resources\GiftResource
     */
    public function update(GiftUpdateRequest $request, Gift $gift)
    {
        $gift->update($request->validated());

        return new GiftResource($gift);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\gift $gift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gift $gift)
    {
        $gift->delete();

        return response()->noContent();
    }
}
