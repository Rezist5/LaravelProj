<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required',
            'recipient_id' => 'required',
            'message' => 'required',
        ]);
        $curUserId = Auth::user()->id;
        $message = Message::create([
            'chat_id' => $request->input('chat_id'),
            'create_time' => now(),
            'author_id' => $curUserId,
            'recipient_id' => $request->input('recipient_id'),
            'message' => $request->input('message'),
        ]);
        // Можете вставить здесь логику отправки уведомлений или другие действия

        return response()->json(['message' => 'Message sent successfully', 'data' => $message]);
    }

    public function startChat(Request $request)
    {
        $request->validate([
            'abonent_1' => 'required',
            'abonent_2' => 'required',
        ]);

        $existingChat = Chat::where('abonent_1', $request->input('abonent_1'))
            ->where('abonent_2', $request->input('abonent_2'))
            ->first();

        if ($existingChat) {
            return response()->json(['message' => 'Chat already exists', 'data' => $existingChat]);
        }

        $chat = Chat::create([
            'abonent_1' => $request->input('abonent_1'),
            'abonent_2' => $request->input('abonent_2'),
        ]);

        return response()->json(['message' => 'Chat started successfully', 'data' => $chat]);
    }
}
