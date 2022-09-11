<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Chat;
use App\Models\Stylist;
use App\Models\Calendar;
use App\Models\StylistSpecialization;
use App\Http\Requests\QuotationRequest;
use App\Http\Requests\QuotationUpdateRequest;
use App\Http\Resources\QuotationCollection;
use App\Http\Resources\QuotationResource;
use Illuminate\Http\Request;
use App\Http\Controllers\ChatController;

class QuotationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\QuotationCollection
     */
    public function index(Request $request)
    {
        $quotations = Quotation::all();

        return new QuotationCollection($quotations);
    }

    /**
     * @param \App\Http\Requests\QuotationStoreRequest $request
     * @return \App\Http\Resources\QuotationResource
     */
    public function store(QuotationRequest $request)
    {
        $quotation = Quotation::create($request->validated());
        
        // Create new message with the quotation info
        $chatController = new ChatController();

        $messageRequest = new Request();
        $messageRequest->stylist_id = $request->stylist_id;
        $messageRequest->user_id = $request->user_id;
        $messageRequest->sender_id = Stylist::find($request->stylist_id)->user_id;
        $messageRequest->message = 'New quotation created by the stylist on ' . $request->date . ' from ' . $request->time . ' and the fees is ' . $request->fees . ' EGP.';
        $messageRequest->type = 'Quotation';
        $messageRequest->quotation_id = $quotation->id;
        $messageRequest->chat_id = Chat::whereUserId($request->user_id)->whereStylistId($request->stylist_id)->first()->id;

        $chatController->sendNewMessage($messageRequest);
        
        return new QuotationResource($quotation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\quotation $quotation
     * @return \App\Http\Resources\QuotationResource
     */
    public function show(Request $request, Quotation $quotation)
    {
        return new QuotationResource($quotation);
    }

    /**
     * @param \App\Http\Requests\QuotationUpdateRequest $request
     * @param \App\quotation $quotation
     * @return \App\Http\Resources\QuotationResource
     */
    public function update(QuotationUpdateRequest $request, Quotation $quotation)
    {
        $quotation->update($request->validated());

        return new QuotationResource($quotation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\quotation $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Quotation $quotation)
    {
        $quotation->delete();

        return response()->noContent();
    }
    
    public function confirmQuotation(Request $request) {
        Quotation::whereId($request->quotation_id)->update([
            'status' => $request->status,
        ]);
        
        $this->createSessionCalendarEvent($request->quotation_id);
        
        return response()->json([
            'status' => true,
            'message' => 'Quotation updated successfully',
        ]);
    }
    
    
    private function createSessionCalendarEvent($quotationId) {
        $quotation = Quotation::find($quotationId);    
        $sessionName = StylistSpecialization::find($quotation->session_type_id)->specialization->title;

        Calendar::insert([
            [
                'user_id' => $quotation->user_id,
                'event_name' => $sessionName,
                'date' => $quotation->date,
                'type' => 'session',
                'event_id' => $quotation->id,
            ],[
                'user_id' => Stylist::find($quotation->stylist_id)->user_id,
                'event_name' => $sessionName,
                'date' => $quotation->date,
                'type' => 'session',
                'event_id' => $quotation->id,
            ]
        ]);
    }
}
