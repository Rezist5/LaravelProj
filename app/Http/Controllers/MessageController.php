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
        $curUser = Auth::user();
        
        $abonentId = $request->input('newChatRecipient');
        $abonentUser = User::where('UserId', $abonentId)->first();
        $existingChat = Chat::where(function ($query) use ($abonentId) {
            $curUser = Auth::user();
            $abonentUser = User::where('UserId', $abonentId)->first();
            $query->where('abonent_1', $curUser->id)->where('abonent_2', $abonentUser->id)
                ->orWhere('abonent_1', $abonentUser->Id)->where('abonent_2', $curUser->Id);
        })->first();
        if ($existingChat) {
            // Если чат уже существует, возвращаем сообщение об этом
            return redirect()->back()->with('message', 'Chat with this user already exists');
        }
        // Создаем новый чат
        $newChat = Chat::create([
            'abonent_1' =>  $curUser->id,
            'abonent_2' => $abonentUser->id,
        ]);

        return response()->json(['message' => 'Chat started successfully', 'data' => $chat]);
    }
}
