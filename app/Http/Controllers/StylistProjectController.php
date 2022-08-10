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
     * Stylist projects
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\StylistProjectCollection
     */
    public function index(Request $request)
    {
        $stylistProjects = StylistProject::whereStylistId($request->stylist_id)
                                          ->with(['images'])  
                                          ->get();

        return new StylistProjectCollection($stylistProjects);
    }

    /**
     * @param \App\Http\Requests\StylistProjectStoreRequest $request
     * @return \App\Http\Resources\StylistProjectResource
     */
    public function store(Request $request)
    {
      if (count($request->all()) == 0) {
        return response()->json(['message' => 'You sent empty projects'], 400);
      } 
      foreach ($request->all() as $key => $project) {
          $newProject = StylistProject::create([
              'stylist_id' => $project['stylist_id'],
              'name' => $project['name'],
              'description' => $project['description'],
          ]);
          /**
           * Store project images
           */
          if ($project['images'] && count($project['images']) > 0) {
              foreach ($project['images'] as $key => $image) {
                  $imagePath = $this->verifyAndStoreImage($image, 
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

      return new StylistProjectCollection($projects);
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
