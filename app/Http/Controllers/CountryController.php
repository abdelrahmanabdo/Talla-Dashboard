<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\CountryRequest;
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

        return new CountryResource($countries);
    }

    /**
     * @param \App\Http\Requests\CountryRequest $request
     * @return \App\Http\Resources\CountryResource
     */
    public function store(CountryRequest $request)
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
    public function update(Request $request, Country $country)
    {
        $country->update($request->all());

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

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);    
    }
}
