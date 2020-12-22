<?php

namespace App\Http\Controllers;

use App\Models\RegistrationChoice;
use App\Http\Requests\RegistrationChoiceRequest;
use App\Http\Resources\RegistrationChoiceResource;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;

class RegistrationChoiceController extends Controller
{
    use StoreImageTrait;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\RegistrationChoiceCollection
     */
    public function index(Request $request)
    {
        if ($request->type) {
          $registrationChoices = RegistrationChoice::whereType($request->type)->get();
        } else {
          $registrationChoices = RegistrationChoice::all();
        }

        return new RegistrationChoiceResource($registrationChoices);
    }

    /**
     * @param \App\Http\Requests\RegistrationChoiceStoreRequest $request
     * @return \App\Http\Resources\RegistrationChoiceResource
     */
    public function store(RegistrationChoiceRequest $request)
    {
        $request['image'] = $this->verifyAndStoreBase64Image($request->image, $request->title,'registration-choices');

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
    public function update(Request $request, RegistrationChoice $registrationChoice)
    {
        $request['image'] = $this->verifyAndStoreBase64Image($request->image, $request->title,'registration-choices');

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
