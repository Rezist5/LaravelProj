<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Chat;
use App\Teacher;
use App\Message;
use App\User;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Lesson;

class ChatPageController extends Controller
{
    public function showChatPage($recepientId = 0)
    {
        
        $curUser = Auth::user();
        $userChats = Chat::where('abonent_1', $curUser->id)
            ->orWhere('abonent_2', $curUser->id)
            ->get();
        if($userChats->count() == 0){
                $recepient = null;
                
                $messages = null;
                $selectedChat = null;
                $userClassId = Student::where('Id', $curUser->UserId)->first()->ClassId;
                $recepients = Teacher::whereHas('lessons', function ($query) use ($userClassId) {
                    $query->where('classId', $userClassId);
                })->get();
                $recepientsChange = [];
                return view('chat', [
                    'recepient' => $recepient,
                    'teachersChange' => $recepientsChange,
                    'currentUser' => $curUser,
                    'userType' => $curUser->UserType,
                    'teachers' => $recepients,
                    'userChats' => $userChats,
                    'selectedChat' => $selectedChat,
                    'messages' => $messages,
                ]);
            }
        if($recepientId == 0)
        {
            $selectedChat = $userChats->first();
            
            if($selectedChat->abonent_1 == $curUser->id)
            {
                $recepient = User::find($selectedChat->abonent_2);
            }
            else
            {
                $recepient = User::find($selectedChat->abonent_1);
            }
            
        }
        else
        {
            if($curUser->UserType == 'teacher')
            {
                
            }
            //находим selectedChat по $recepientId\
            $TeachUser = User::where('UserId', $recepientId)->first();
            $TeachUserId = $TeachUser->id;

            $recepient = $TeachUser;
            $selectedChat = Chat::where(function ($query) use ($curUser, $TeachUserId) {
                $query->where('abonent_1', $curUser->id)
                    ->where('abonent_2', $TeachUserId);
            })->orWhere(function ($query) use ($curUser, $TeachUserId) {
                $query->where('abonent_1', $TeachUserId)
                    ->where('abonent_2', $curUser->id);
            })->first();
            
        }
        if($curUser->UserType == 'teacher') {
            $userClass = Teacher::where('Id', $curUser->UserId)->first();
            $recepients = $userClass->getStudents();
        }
        if($curUser->UserType == 'student') {
            $userClassId = Student::where('Id', $curUser->UserId)->first()->ClassId;
            $recepients = Teacher::whereHas('lessons', function ($query) use ($userClassId) {
                $query->where('classId', $userClassId);
            })->get();  
        }
        $allChats = Chat::where('abonent_1', $curUser->id)->get();
        
        if($allChats->count() > 0)
        {         
            $teacherIds = $allChats->pluck('abonent_2')->unique();
            if($selectedChat)
            {
                $messages = Message::where('chat_id', $selectedChat->id)->get();
            }
            else
            {

                $messages = [];
            }
            $userTempIds = User::whereIn('id', $teacherIds);
            if($curUser->UserType == 'teacher')
            {
                $recepientsChange = Student::whereIn('Id', $userTempIds->pluck('UserId'))->get();
            
            }
            else if($curUser->UserType == 'student')
            {
                $recepientsChange = Teacher::whereIn('Id', $userTempIds->pluck('UserId'))->get();
            }
        }   
        else
        {
            $allChats = Chat::where('abonent_2', $curUser->id)->get();
            $teacherIds = $allChats->pluck('abonent_1')->unique();
            
            $messages = Message::where('chat_id', $selectedChat->id)->get();
            $userTempIds = User::whereIn('id', $teacherIds);
            if($curUser->UserType == 'teacher')
            {
                $recepientsChange = Student::whereIn('Id', $userTempIds->pluck('UserId'))->get();
            
            }
            else if($curUser->UserType == 'student')
            {
                $recepientsChange = Teacher::whereIn('Id', $userTempIds->pluck('UserId'))->get();
            }
            
        }
        return view('chat', [
            'recepient' => $recepient,
            'teachersChange' => $recepientsChange,
            'currentUser' => $curUser,
            'userType' => $curUser->UserType,
            'teachers' => $recepients,
            'userChats' => $userChats,
            'selectedChat' => $selectedChat,
            'messages' => $messages,
        ]);
    }
    public function sendChatMessage(Request $request)
    {
        $selectedChat = $request->input('chat_id');
        $messagecontorller = new MessageController();
        $message = $messagecontorller->sendMessage($request);

        return ChatPageController::showChatPage($selectedChat);
    }
    public function startChat(Request $request)
    {
        $curUser = Auth::user();
        
        $abonentId = $request->input('newChatRecipient');
        if($curUser->usertype = 'student')
        {

            $abonentUser = User::where('UserId', $abonentId)->where('UserType', 'teacher')->first();
           
        }
        else
        {
            $abonentUser = User::where('UserId', $abonentId)->where('UserType', 'student')->first();

        }
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


        return redirect()->back()->with('message', 'Chat started successfully');
    }
    // public function changeChat($teacherId = 0)
    // {
    //     //ПЕРЕДЕЛАТЬ
    //     $selectedChat = Chat::where(function ($query) use ($teacherId) {
    //         $curUserId = Auth::user()->id;
    //         $query->where('abonent_1', $curUserId)->where('abonent_2', $teacherId)
    //             ->orWhere('abonent_1', $teacherId)->where('abonent_2', $curUserId);
    //     })->first();
    //     $messages = ($selectedChat) ? Message::where('chat_id', $selectedChat->id)->get() : [];
    //     Log::info($selectedChat);

    //     return ChatPageController::showChatPage($selectedChat);
    // }
}