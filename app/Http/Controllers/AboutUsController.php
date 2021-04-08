<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Http\Requests\AboutUsRequest;
use App\Http\Resources\AboutUsResource;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ColorCollection
     */
    public function index(Request $request)
    {
        $about = AboutUs::first();

        return new AboutUsResource($about);
    }

    /**
     * @param \App\Http\Requests\AboutUsResource $request
     * @return \App\Http\Resources\AboutUsResource
     */
    public function store(AboutUsRequest $request)
    {
        $about = AboutUs::create($request->validated());

        return new AboutUsResource($about);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\AboutUs $About
     * @return \App\Http\Resources\AboutUsResource
     */
    public function show(Request $request, AboutUs $about)
    {
        return new AboutUsResource($about);
    }

    /**
     * @param \App\Http\Requests\ColorUpdateRequest $request
     * @param \App\About $About
     * @return \App\Http\Resources\AboutUsResource
     */
    public function update(Request $request, AboutUs $about)
    {
        $about->update($request->all());

        return new AboutUsResource($about);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\AboutUs $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AboutUs $about)
    {
        $about->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
