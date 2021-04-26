<?php

namespace App\Http\Controllers;

use App\Http\Requests\StylistCertificateRequest;
use App\Http\Resources\StylistCertificateResource;
use App\Models\StylistCertificate;
use App\Models\Stylist;
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
      if (count($request->all()) == 0) {
        return response()->json(['message' => 'You sent empty certificates'], 400);
      } 

      $stylist_id = $request->all()[0]['stylist_id'];
      $stylist = Stylist::find($stylist_id);
      // Delete old certificates
      $stylist->certificates()->delete();

      // Add new certificates
      foreach ($request->all() as $key => $certificate) {
        $stylist_id = $certificate['stylist_id'];
        StylistCertificate::create([
          'stylist_id' => $stylist_id,
          'certificate_name' => $certificate['certificate_name'],
          'organization_name' => $certificate['organization_name'],
          'issurance_year' => $certificate['issurance_year'],
        ]);
      }

      $stylist_certificates = StylistCertificate::whereStylistId($stylist_id)->get();
      return new StylistCertificateResource($stylist_certificates);
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
