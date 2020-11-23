<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportStoreRequest;
use App\Http\Requests\SupportUpdateRequest;
use App\Http\Resources\SupportCollection;
use App\Http\Resources\SupportResource;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\SupportCollection
     */
    public function index(Request $request)
    {
        $supports = Support::all();

        return new SupportCollection($supports);
    }

    /**
     * @param \App\Http\Requests\SupportStoreRequest $request
     * @return \App\Http\Resources\SupportResource
     */
    public function store(SupportStoreRequest $request)
    {
        $support = Support::create($request->validated());

        return new SupportResource($support);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\support $support
     * @return \App\Http\Resources\SupportResource
     */
    public function show(Request $request, Support $support)
    {
        return new SupportResource($support);
    }

    /**
     * @param \App\Http\Requests\SupportUpdateRequest $request
     * @param \App\support $support
     * @return \App\Http\Resources\SupportResource
     */
    public function update(SupportUpdateRequest $request, Support $support)
    {
        $support->update($request->validated());

        return new SupportResource($support);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\support $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Support $support)
    {
        $support->delete();

        return response()->noContent();
    }
}
