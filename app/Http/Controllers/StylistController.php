<?php

namespace App\Http\Controllers;

use App\Http\Requests\StylistStoreRequest;
use App\Http\Requests\StylistUpdateRequest;
use App\Http\Resources\StylistCollection;
use App\Http\Resources\StylistResource;
use App\Models\Stylist;
use Illuminate\Http\Request;

class StylistController extends Controller
{
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
     * @param \App\Http\Requests\StylistStoreRequest $request
     * @return \App\Http\Resources\StylistResource
     */
    public function store(StylistStoreRequest $request)
    {
        $stylist = Stylist::create($request->validated());

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
     * @param \App\Http\Requests\StylistUpdateRequest $request
     * @param \App\stylist $stylist
     * @return \App\Http\Resources\StylistResource
     */
    public function update(StylistUpdateRequest $request, Stylist $stylist)
    {
        $stylist->update($request->validated());

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

        return response()->noContent();
    }
}
