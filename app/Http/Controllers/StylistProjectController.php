<?php

namespace App\Http\Controllers;

use App\Http\Requests\StylistProjectRequest;
use App\Http\Requests\StylistProjectUpdateRequest;
use App\Http\Resources\StylistProjectCollection;
use App\Http\Resources\StylistProjectResource;
use App\Models\StylistProject;
use App\Models\StylistProjectImage;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;

class StylistProjectController extends Controller
{
    use StoreImageTrait;
    
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
    public function store(StylistProjectRequest $request)
    {
        foreach ($request->all() as $key => $project) {
            $newProject = StylistProject::create([
                'stylist_id' => $project['stylist_id'],
                'name' => $project['name'],
                'description' => $project['description'],
            ]);

            /**
             * Store project images
             */
            if ($project['images']) {
                foreach ($project['images'] as $key => $image) {
                    $imagePath = $this->verifyAndStoreBase64Image($image, 
                                                                 $project['stylist_id'] .'-'. $project['name'] . '-' . $key , 
                                                                 'projects');
                    StylistProjectImage::create([
                        'project_id' => $newProject->id,
                        'image'   => $imagePath
                    ]);
                }
            }
        }

        $projects = $request->all();

        return new StylistProjectResource($projects);
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
