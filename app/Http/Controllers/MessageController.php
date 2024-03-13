<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessageController extends Controller
{
    
    public static function saveMessage($data)
    {
        $message = new Message();
        $message->author_id = $data['author_id']; // Предполагается, что вы отправляете id отправителя
        $message->recipient_id = $data['recipient_id']; // Предполагается, что вы отправляете id получателя
        $message->message = $data['message']; // Сохраняем текст сообщения
        $message->save(); // Сохраняем сообщение в базе данных
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
