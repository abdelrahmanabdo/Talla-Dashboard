<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecializationStoreRequest;
use App\Http\Requests\SpecializationUpdateRequest;
use App\Http\Resources\SpecializationCollection;
use App\Http\Resources\SpecializationResource;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\SpecializationCollection
     */
    public function index(Request $request)
    {
        $specializations = Specialization::all();

        return new SpecializationCollection($specializations);
    }

    /**
     * @param \App\Http\Requests\SpecializationStoreRequest $request
     * @return \App\Http\Resources\SpecializationResource
     */
    public function store(SpecializationStoreRequest $request)
    {
        $specialization = Specialization::create($request->validated());

        return new SpecializationResource($specialization);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\specialization $specialization
     * @return \App\Http\Resources\SpecializationResource
     */
    public function show(Request $request, Specialization $specialization)
    {
        return new SpecializationResource($specialization);
    }

    /**
     * @param \App\Http\Requests\SpecializationUpdateRequest $request
     * @param \App\specialization $specialization
     * @return \App\Http\Resources\SpecializationResource
     */
    public function update(SpecializationUpdateRequest $request, Specialization $specialization)
    {
        $specialization->update($request->validated());

        return new SpecializationResource($specialization);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\specialization $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Specialization $specialization)
    {
        $specialization->delete();

        return response()->noContent();
    }
}
