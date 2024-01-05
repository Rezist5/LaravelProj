<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lesson;
use App\Student;
use App\Teacher;


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
    
            return view('lessons', ['lessons' => $lessons, 'selectedDate' => $date]);
        } else {
            return redirect('/login');
        }
    }
    public function getLessonsForToday()
{
    if (Auth::check()) {
        $currentUser = Auth::user();
        if($currentUser->UserType == "student")
        {
            $student = Student::where('Id', $currentUser->UserId)->first();
            $classId = $student->classId;
            $today = now()->toDateString(); 
            
            $lessons = Lesson::where('classId', $classId)
                ->where('LessonDate', $today)
                ->orderBy('LessonNumber')
                ->get();
    
            return $lessons;
        }
        else if($currentUser->UserType == "teacher")
        {
            $teacher = Teacher::where('userId', $currentUser->id)->first();
            $today = now()->toDateString(); 
    
            $lessons = Lesson::where('TeacherId', $teacher->id)
                ->where('LessonDate', $today)
                ->orderBy('LessonNumber')
                ->get();
    
            return $lessons;
        }
        
    } else {
        return redirect('/login');
    }
}

    
}