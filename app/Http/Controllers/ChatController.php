<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Chat;

class ChatController extends Controller
{
    /**
     * Get user chats
     * @param \Illuminate\Http\Request $request
     */
    public function getUserChats(Request $request) {
        $validator = Validator::make($request->all(), [ 'user_id' => 'required' ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'errors'=>$validator->errors()->all()
            ], 422);
        }

        $chats = Chat::where('user_1', $request->user_id)
                    ->orWhere('user_2', $request->user_id)
                    ->with(['user'])
                    ->get();

        return response()->json([
            "success" => true,
            "data" => $chats
        ]);
    }

    /**
     * Get chat messages
     * @param \Illuminate\Http\Request $request
     */
    public function getChatMessages(Request $request) {
        $validator = Validator::make($request->all(), ['chat_ref' => 'required']);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'errors'=>$validator->errors()->all()
            ], 422);
        }

        $messages = [];

        return response()->json([
            "success" => true,
            "data" => $messages
        ]);
    }

    /**
     * Send new message
     * @param \Illuminate\Http\ChatRequest $request
     */
    public function sendNewMessage(ChatRequest $request) {
        // First user
        $sender = $request->sender_id;
        // Second user
        $receiver = $request->receiver_id;
        // Check if already there is a chat for these two users
        $chat = $this->isChatExist($sender, $receiver);
        // In case of no chat
        if (!$chat) {
            // New chat ref => concatenate $user$user2$random
            $newChatRef = $sender.$receiver.rand(100000, 999999);
            // Create new chat record
            $chat = Chat::create([
                'chat_ref' => $newChatRef,
                'user_1' => $sender,
                'user_2' => $receiver,
            ]);
        }


    }


    /**
     * Check if already there is a chat for two users
     * @param {$user1} int
     * @param {$user2} int
     * @return Boolean
     */
    private function isChatExist ($user1, $user2) {
        $chat = Chat::where(['user_1' => $user1, 'user_2' => $user2])
                        ->orWhere(['user_1' => $user2, 'user_2' => $user1])
                        ->first();
        return $chat;
    }
}
