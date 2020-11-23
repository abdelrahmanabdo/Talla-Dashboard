<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\CountryCollection
     */
    public function index(Request $request)
    {
        $countries = Country::all();

        return new CountryCollection($countries);
    }

    /**
     * @param \App\Http\Requests\CountryStoreRequest $request
     * @return \App\Http\Resources\CountryResource
     */
    public function store(CountryStoreRequest $request)
    {
        $country = Country::create($request->validated());

        return new CountryResource($country);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\country $country
     * @return \App\Http\Resources\CountryResource
     */
    public function show(Request $request, Country $country)
    {
        return new CountryResource($country);
    }

    /**
     * @param \App\Http\Requests\CountryUpdateRequest $request
     * @param \App\country $country
     * @return \App\Http\Resources\CountryResource
     */
    public function update(CountryUpdateRequest $request, Country $country)
    {
        $country->update($request->validated());

        return new CountryResource($country);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Country $country)
    {
        $country->delete();

        return response()->noContent();
    }
}
