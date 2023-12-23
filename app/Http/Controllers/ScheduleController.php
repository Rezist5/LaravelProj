<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson; 

class ScheduleController extends Controller
{
    
    public function getLessonsByDate($date)
    {
        if (Auth::check()) {
            $currentUser = Auth::user();

            $lessons = Lesson::where('classId', $currentUser->classId)
                ->where('LessonDate', $date)
                ->orderBy('LessonNumber')
                ->get();

            return view('lessons_by_date', ['lessons' => $lessons, 'lessonDate' => $date]);
        } else {
            return redirect('/login');
        }
    }
        
    
}