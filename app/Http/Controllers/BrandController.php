<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\BrandCollection
     */
    public function index(Request $request)
    {
        $brands = Brand::all();

        return new BrandResource($brands);
    }

    /**
     * @param \App\Http\Requests\BrandStoreRequest $request
     * @return \App\Http\Resources\BrandResource
     */
    public function store(BrandRequest $request)
    {
        $brand = Brand::create($request->validated());

        return new BrandResource($brand);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\brand $brand
     * @return \App\Http\Resources\BrandResource
     */
    public function show(Request $request, Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * @param \App\Http\Requests\BrandUpdateRequest $request
     * @param \App\brand $brand
     * @return \App\Http\Resources\BrandResource
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());

        return new BrandResource($brand);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
