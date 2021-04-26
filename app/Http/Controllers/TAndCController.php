<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TAndC;
use App\Http\Resources\TAndCResource;

class TAndCController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ColorCollection
     */
    public function index(Request $request)
    {
      $tAndc = TAndC::first();

      $data = [
        'text' => $tAndc->text ?? '',
        'text_ar' => $tAndc->text_ar ?? '',
      ];
      return response()->json([
        'success' => true,
        'data' => $data
      ]);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return \App\Http\Resources\TAndCResource
     */
    public function store(Request $request)
    {
      $about = TAndC::create([
        'text' => $request->text,
        'text_ar' => $request->text_ar
      ]);

      return new TAndCResource($about);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\TAndC $tAndc
     * @return \App\Http\Resources\TAndCResource
     */
    public function show(Request $request, TAndC $about)
    {
        return new TAndCResource($about);
    }

    /**
     * @param \App\Http\Requests\ColorUpdateRequest $request
     * @param \App\TAndC $About
     * @return \App\Http\Resources\TAndCResource
     */
    public function update(Request $request, TAndC $tAndc)
    {
        $tAndc->update($request->all());

        return new TAndCResource($tAndc);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\TAndC $tAndc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TAndC $tAndc)
    {
        $tAndc->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
