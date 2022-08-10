<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Stylist;
use \App\Handlers\NotificationHandler;

class ChatController extends Controller
{
    /**
     * Get user chats
     * @param \Illuminate\Http\Request $request
     */
    public function getUserChats(Request $request) {
      $userId = $request->user_id;
      $stylistId = $request->stylist_id;
      $chats = Chat::when($userId, function($query, $userId) {
                      return $query->where('user_id', $userId);
                    })
                    ->when($stylistId, function($query, $stylistId) {
                      return $query->where('stylist_id', $stylistId);
                    })
                    ->with(['user', 'stylist.user'])
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
        $validator = Validator::make($request->all(), [
          'chat_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'errors'=>$validator->errors()->all()
            ], 422);
        }

        $messages = Chat::whereId($request->chat_id)
                    ->with(['messages.user', 'user', 'stylist.user'])
                   ->first();

        return response()->json([
            "success" => true,
            "data" => $messages
        ]);
    }

    /**
     * Send new message
     * @param \Illuminate\Http\ChatRequest $request
     */
    public function sendNewMessage(Request $request) {
      $stylistId = $request->stylist_id;
      $userId = $request->user_id;
      $senderId = $request->sender_id;
      $chatId = $request->chat_id;
      $stylistUserId = Stylist::find($stylistId)->id;

      if (!$chatId){
        // Create new chat record
        $chatId = Chat::create([
          'stylist_id' => $stylistId,
          'user_id' => $userId,
        ])->id;
      }

      $message = Message::create([
        'chat_id' => $chatId,
        'user_id' => $senderId,
        'type' => $request->type,
        'message' => $request->message
      ]);

      $receiverId = $stylistUserId !== $senderId ? $stylistUserId : $userId;
      
      if($user && ($user->user_id != $userId)) {
        new NotificationHandler(
          'new_message',
          array('user_id'=>[$receiverId]),
          array('message' => $request->message)
        );    
      }

      return response()->json([
        'success' => true,
        'chat_id' => $chatId,
        'message' => $message,
      ]);
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Chat;
use App\Models\Message;

class ChatController extends Controller
{
    /**
     * Get user chats
     * @param \Illuminate\Http\Request $request
     */
    public function getUserChats(Request $request) {
      $userId = $request->user_id;
      $stylistId = $request->stylist_id;
      $chats = Chat::when($userId, function($query, $userId) {
                      return $query->where('user_id', $userId);
                    })
                    ->when($stylistId, function($query, $stylistId) {
                      return $query->where('stylist_id', $stylistId);
                    })
                    ->with(['user', 'stylist.user'])
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
        $validator = Validator::make($request->all(), [
          'chat_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'errors'=>$validator->errors()->all()
            ], 422);
        }

        $messages = Chat::whereId($request->chat_id)
                    ->with(['messages.user', 'user', 'stylist.user'])
                   ->first();

        return response()->json([
            "success" => true,
            "data" => $messages
        ]);
    }

    /**
     * Send new message
     * @param \Illuminate\Http\ChatRequest $request
     */
    public function sendNewMessage(Request $request) {
      $stylistId = $request->stylist_id;
      $userId = $request->user_id;
      $senderId = $request->sender_id;
      $chatId = $request->chat_id;

      if (!$chatId){
        // Create new chat record
        $chatId = Chat::create([
          'stylist_id' => $stylistId,
          'user_id' => $userId,
        ])->id;
      }

      $message = Message::create([
        'chat_id' => $chatId,
        'user_id' => $senderId,
        'type' => $request->type,
        'message' => $request->message
      ]);

      return response()->json([
        'success' => true,
        'chat_id' => $chatId,
        'message' => $message,
      ]);
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
