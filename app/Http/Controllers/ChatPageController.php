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
    public function showChatPage($teacherId = 0)
    {
        $curUser = Auth::user();
        $userChats = Chat::where('abonent_1', $curUser->id)
            ->orWhere('abonent_2', $curUser->id)
            ->get();
        
        if($teacherId == 0)
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
            //находим selectedChat по $teacherId
            $TeachUser = User::where('UserId', $teacherId)->first();
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
            $teachers = $userClass->getStudents();
        }
        if($curUser->UserType == 'student') {
            $userClassId = Student::where('Id', $curUser->UserId)->first()->ClassId;
            $teachers = Teacher::whereHas('lessons', function ($query) use ($userClassId) {
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
                $teachersChange = Student::whereIn('Id', $userTempIds->pluck('UserId'))->get();
            
            }
            else if($curUser->UserType == 'student')
            {
                $teachersChange = Teacher::whereIn('Id', $userTempIds->pluck('UserId'))->get();
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
                $teachersChange = Student::whereIn('Id', $userTempIds->pluck('UserId'))->get();
            
            }
            else if($curUser->UserType == 'student')
            {
                $teachersChange = Teacher::whereIn('Id', $userTempIds->pluck('UserId'))->get();
            }
            
        }
        //dd($selectedChat->id);
        return view('chat', [
            'recepient' => $recepient,
            'teachersChange' => $teachersChange,
            'currentUser' => $curUser,
            'userType' => $curUser->UserType,
            'teachers' => $teachers,
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
        
        $messagecontorller = new MessageController();
        $message = $messagecontorller->startChat($request);

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