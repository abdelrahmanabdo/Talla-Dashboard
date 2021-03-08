<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \App\Handlers\NotificationHandler;

class NotificationController extends Controller
{
    /**
     * Get all user notifications
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = User::find($request->user_id)->notifications;

        return response()->json([
            'success' => true,
            'data'    => $notifications
        ]);
    }

    /**
     * Mark notification as read
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function markNotification(Request $request)
    {
        User::whereId($request->user_id)
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->id);
            })
            ->markAsRead();

        return response()->noContent();
    }

    /**
     * Delete user notification
     * @param \Illuminate\Http\Request $request
     * @param \App\blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }

    /**
     *  test notifications
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
                new NotificationHandler('new_order',
                                       array('user_id'=>[2 ,'store_id' => 1]),
                                       array('order_code'=> 141414124));

        return response([
            'success' => false,
            'mesage'  => 'New OTP valid for 10 mins only',
            'data'    => $newOtp
        ],200);
    }



}
