<?php

namespace App\Http\Controllers;

use App\Http\Requests\StylistCertificateStoreRequest;
use App\Http\Requests\StylistCertificateUpdateRequest;
use App\Http\Resources\StylistCertificateCollection;
use App\Http\Resources\StylistCertificateResource;
use App\Models\StylistCertificate;
use Illuminate\Http\Request;

class StylistCertificateController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\StylistCertificateCollection
     */
    public function index(Request $request)
    {
        $stylistCertificates = StylistCertificate::all();

        return new StylistCertificateCollection($stylistCertificates);
    }

    /**
     * @param \App\Http\Requests\StylistCertificateStoreRequest $request
     * @return \App\Http\Resources\StylistCertificateResource
     */
    public function store(StylistCertificateStoreRequest $request)
    {
        $stylistCertificate = StylistCertificate::create($request->validated());

        return new StylistCertificateResource($stylistCertificate);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylistCertificate $stylistCertificate
     * @return \App\Http\Resources\StylistCertificateResource
     */
    public function show(Request $request, StylistCertificate $stylistCertificate)
    {
        return new StylistCertificateResource($stylistCertificate);
    }

    /**
     * @param \App\Http\Requests\StylistCertificateUpdateRequest $request
     * @param \App\stylistCertificate $stylistCertificate
     * @return \App\Http\Resources\StylistCertificateResource
     */
    public function update(StylistCertificateUpdateRequest $request, StylistCertificate $stylistCertificate)
    {
        $stylistCertificate->update($request->validated());

        return new StylistCertificateResource($stylistCertificate);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylistCertificate $stylistCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StylistCertificate $stylistCertificate)
    {
        $stylistCertificate->delete();

        return response()->noContent();
    }
}
