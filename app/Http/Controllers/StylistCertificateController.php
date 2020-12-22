<?php

namespace App\Http\Controllers;

use App\Http\Requests\StylistCertificateRequest;
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

        return new StylistCertificateResource($stylistCertificates);
    }

    /**
     * @param \App\Http\Requests\StylistCertificateRequest $request
     * @return \App\Http\Resources\StylistCertificateResource
     */
    public function store(Request $request)
    {
        foreach ($request->all() as $key => $certificate) {
            StylistCertificate::create([
                'stylist_id' => $certificate['stylist_id'],
                'certificate_name' => $certificate['certificate_name'],
                'organization_name' => $certificate['organization_name'],
                'issurance_year' => $certificate['issurance_year'],
            ]);
        }

        $stylistCertificate = $request->all() ;
        
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
     * @param \Illuminate\Http\Request $request
     * @param \App\stylistCertificate $stylistCertificate
     * @return \App\Http\Resources\StylistCertificateResource
     */
    public function update(Request $request, StylistCertificate $stylistCertificate)
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
