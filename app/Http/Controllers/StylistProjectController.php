<?php

namespace App\Http\Controllers;

use App\Http\Requests\StylistProjectStoreRequest;
use App\Http\Requests\StylistProjectUpdateRequest;
use App\Http\Resources\StylistProjectCollection;
use App\Http\Resources\StylistProjectResource;
use App\Models\StylistProject;
use Illuminate\Http\Request;

class StylistProjectController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\StylistProjectCollection
     */
    public function index(Request $request)
    {
        $stylistProjects = StylistProject::all();

        return new StylistProjectCollection($stylistProjects);
    }

    /**
     * @param \App\Http\Requests\StylistProjectStoreRequest $request
     * @return \App\Http\Resources\StylistProjectResource
     */
    public function store(StylistProjectStoreRequest $request)
    {
        $stylistProject = StylistProject::create($request->validated());

        return new StylistProjectResource($stylistProject);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylistProject $stylistProject
     * @return \App\Http\Resources\StylistProjectResource
     */
    public function show(Request $request, StylistProject $stylistProject)
    {
        return new StylistProjectResource($stylistProject);
    }

    /**
     * @param \App\Http\Requests\StylistProjectUpdateRequest $request
     * @param \App\stylistProject $stylistProject
     * @return \App\Http\Resources\StylistProjectResource
     */
    public function update(StylistProjectUpdateRequest $request, StylistProject $stylistProject)
    {
        $stylistProject->update($request->validated());

        return new StylistProjectResource($stylistProject);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylistProject $stylistProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StylistProject $stylistProject)
    {
        $stylistProject->delete();

        return response()->noContent();
    }
}
