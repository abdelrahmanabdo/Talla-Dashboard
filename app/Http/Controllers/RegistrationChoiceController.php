<?php

namespace App\Http\Controllers;

use App\Models\RegistrationChoice;
use App\Http\Requests\RegistrationChoiceStoreRequest;
use App\Http\Requests\RegistrationChoiceUpdateRequest;
use App\Http\Resources\RegistrationChoiceCollection;
use App\Http\Resources\RegistrationChoiceResource;
use Illuminate\Http\Request;

class RegistrationChoiceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\RegistrationChoiceCollection
     */
    public function index(Request $request)
    {
        $registrationChoices = RegistrationChoice::all();

        return new RegistrationChoiceCollection($registrationChoices);
    }

    /**
     * @param \App\Http\Requests\RegistrationChoiceStoreRequest $request
     * @return \App\Http\Resources\RegistrationChoiceResource
     */
    public function store(RegistrationChoiceStoreRequest $request)
    {
        $registrationChoice = RegistrationChoice::create($request->validated());

        return new RegistrationChoiceResource($registrationChoice);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\registrationChoice $registrationChoice
     * @return \App\Http\Resources\RegistrationChoiceResource
     */
    public function show(Request $request, RegistrationChoice $registrationChoice)
    {
        return new RegistrationChoiceResource($registrationChoice);
    }

    /**
     * @param \App\Http\Requests\RegistrationChoiceUpdateRequest $request
     * @param \App\registrationChoice $registrationChoice
     * @return \App\Http\Resources\RegistrationChoiceResource
     */
    public function update(RegistrationChoiceUpdateRequest $request, RegistrationChoice $registrationChoice)
    {
        $registrationChoice->update($request->validated());

        return new RegistrationChoiceResource($registrationChoice);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\registrationChoice $registrationChoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RegistrationChoice $registrationChoice)
    {
        $registrationChoice->delete();

        return response()->noContent();
    }
}
