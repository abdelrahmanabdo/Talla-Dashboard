<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;

class SubscriptionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ColorCollection
     */
    public function index(Request $request)
    {
        $subscription = Subscription::first();

        return new SubscriptionResource($subscription);
    }

    /**
     * @param \App\Http\Requests\SubscriptionResource $request
     * @return \App\Http\Resources\SubscriptionResource
     */
    public function store(SubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->validated());

        return new SubscriptionResource($subscription);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Subscription $Subscription
     * @return \App\Http\Resources\SubscriptionResource
     */
    public function show(Request $request, Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    /**
     * @param \App\Http\Requests\ColorUpdateRequest $request
     * @param \App\Subscription $Subscription
     * @return \App\Http\Resources\SubscriptionResource
     */
    public function update(Request $request, Subscription $subscription)
    {
        $subscription->update($request->all());

        return new SubscriptionResource($subscription);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Subscription $subscription)
    {
        $subscription->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
