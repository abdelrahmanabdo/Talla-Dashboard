<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportRequest;
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

        return SupportResource::collection($supports);
    }

    /**
     * @param \App\Http\Requests\SupportRequest $request
     * @return \App\Http\Resources\SupportResource
     */
    public function store(SupportRequest $request)
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
     * @param \App\Http\Requests\SupportRequest $request
     * @param \App\support $support
     * @return \App\Http\Resources\SupportResource
     */
    public function update(SupportRequest $request, Support $support)
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

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);    
    }
}
